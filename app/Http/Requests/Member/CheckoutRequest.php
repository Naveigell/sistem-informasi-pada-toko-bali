<?php

namespace App\Http\Requests\Member;

use App\Models\Shipping;
use App\Models\ShippingCost;
use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $areas = ShippingCost::query()->pluck('id');

        return [
            "address"          => "required|string|min:4|max:255",
            "phone"            => "required|digits_between:7,15",
            "shipping_service" => "required|string|in:" . join(',', [Shipping::SERVICE_OUR_COURIER, Shipping::SERVICE_REGULAR]),
            "area_id"          => "required|integer|in:" . $areas->join(','),
        ];
    }
}
