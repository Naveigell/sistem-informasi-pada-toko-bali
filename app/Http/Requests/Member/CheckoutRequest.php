<?php

namespace App\Http\Requests\Member;

use App\Helper\RajaOngkir;
use App\Models\Cart;
use App\Models\Shipping;
use App\Models\ShippingCost;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    private $cost, $weight;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "address"          => "required|string|min:4|max:255",
            "phone"            => "required|digits_between:7,15",
            "shipping_service" => "required|string|in:" . join(',', [Shipping::SERVICE_OUR_COURIER, Shipping::SERVICE_REGULAR]),
        ];

        // calculate the weight of products
        $weight = Cart::memberCarts()->with('product')->get()
                                    ->reduce(function ($total, $cart) {
                                        return $total + ($cart->product->weight * $cart->quantity);
                                    }, 0);

        // different rule between regular shipping service and own courier shipping
        // service
        if (in_array($this->get('shipping_service'), [Shipping::SERVICE_REGULAR])) {

            // we need check if request has city and courier first
            // because if request doesn't have city and courier,
            // it will validate the city and courier
            if ($this->get('city') && $this->get('courier')) {

                $weight = Cart::memberCarts()->with('product')->get()
                                             ->reduce(function ($total, $cart) {
                                                 return $total + ($cart->product->weight * $cart->quantity);
                                             }, 0);

                // set the cost that we get from external API
                $this->cost   = RajaOngkir::cost($this->get('city'), $weight, $this->get('courier'));

                // clamp shipping type, and prevent shipping type not less than 0
                $shippingTypeMaximum    = max(count($this->cost[0]['costs']) - 1, 0);

                $rules['shipping_type'] = "required|integer|min:0|max:{$shippingTypeMaximum}";
            }

            $rules['zip']      = "required|integer|digits_between:3,8";
            $rules['city']     = "required|integer|min:1";
            $rules['courier']  = "required|string|in:" . join(',', array_keys(Shipping::SHIPPING_REGULAR_COURIER));
            $rules['province'] = "required|integer|min:1";

        } else if (in_array($this->get('shipping_service'), [Shipping::SERVICE_OUR_COURIER])) {

            $areas = ShippingCost::query()->pluck('id');

            $rules['area_id'] = "required|integer|in:" . $areas->join(',');

            $this->cost = ShippingCost::query()->findOrFail($this->get('area_id'))->cost;
        }

        // set the weight to current weight
        $this->weight = $weight;

        return $rules;
    }

    protected function passedValidation()
    {
        // calculate the total payment of member order
        $totalPayment = Cart::memberCarts()->with('product')->get()
                                                                    ->reduce(function ($total, $cart) {
                                                                        return $total + ($cart->product->price * $cart->quantity);
                                                                    }, 0);

        // add total and weight into request
        $this->request->add([
            "total"  => $totalPayment,
            "weight" => $this->weight,
        ]);

        // if shipping service is regular, get cost from external API
        // else get from own area_id
        if (in_array($this->get('shipping_service'), [Shipping::SERVICE_REGULAR])) {
            $this->request->add(["cost" => $this->cost[0]['costs'][$this->get('shipping_type')]['cost'][0]['value']]);
        } else {
            $this->request->add(["cost" => $this->cost]);
        }
    }
}
