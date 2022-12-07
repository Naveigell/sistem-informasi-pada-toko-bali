<?php

namespace App\Http\Requests\Member;

use Illuminate\Foundation\Http\FormRequest;

class BiodataAvatarRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "avatar" => "nullable|file|mimes:png,jpg,jpeg|max:" . (1024 * 8),
        ];
    }
}
