<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "name"        => "required|string|min:4|max:255",
            "description" => "required|string|min:10|max:5000",
            "stock"       => "required|integer|min:1|max:1000",
            "price"       => "required|integer|min:1000|max:10000000",
            "category"    => "required|integer|min:1",
            "image"       => "required|image|min:100|max:10000",
        ];

        if ($this->isMethod('put')) {
            $rules['image'] = "nullable|image|min:100|max:10000";
        }

        return $rules;
    }
}
