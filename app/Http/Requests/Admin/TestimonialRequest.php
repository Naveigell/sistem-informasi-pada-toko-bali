<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "username"    => "required|string|min:3|max:255",
            "description" => "required|string|min:3|max:2000",
            "star"        => "required|integer|min:1|max:5",
        ];
    }
}
