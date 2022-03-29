<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "star"        => "required|integer|min:1|max:5",
            "description" => "required|string|min:10|max:2000",
        ];
    }
}
