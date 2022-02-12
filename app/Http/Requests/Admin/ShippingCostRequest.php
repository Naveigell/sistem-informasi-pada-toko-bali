<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "area" => "required|string|min:5|max:191",
            "cost" => "required|integer|min:4|max:999999999",
        ];
    }
}
