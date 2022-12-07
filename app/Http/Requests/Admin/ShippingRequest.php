<?php

namespace App\Http\Requests\Admin;

use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed approve
 */
class ShippingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /** @var Shipping $shipping */
        $shipping = $this->route('shipping');
        $shipping->load('payment');

        $rules = [
            "approve" => "required|string|in:" . join(',', array_keys(Payment::STATUSES)),
        ];

        // if payment is valid, we need the tracking id
        if (optional($shipping->payment)->status === array_keys(Payment::STATUSES)[0]) {
            $rules = [
                "shipping_status" => "required|string|in:" . join(',', array_keys(Shipping::SHIPPING_STATUSES)),
            ];

            // if tracking id is not available yet
            if (!$shipping->tracking_id && $shipping->shipping_service === Shipping::SERVICE_REGULAR) {
                $rules["tracking_id"] = "required|string|min:3|max:191";
            }
        }

        return $rules;
    }

    protected function passedValidation()
    {
        $this->request->add(['status' => $this->approve]);
    }
}
