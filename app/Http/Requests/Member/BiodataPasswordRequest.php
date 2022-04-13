<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class BiodataPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "password"        => "required|string|max:30|same:retype_password",
            "retype_password" => "required|string|max:30|same:password",
            "old_password"    => "required|string|max:30",
        ];
    }
}
