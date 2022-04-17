<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name"     => "required|string|max:255",
            "username" => "required|string|alpha_dash|unique:users",
            "email"    => "required|string|email|unique:users",
            "role"     => "required|string|in:" . join(',', [User::ROLE_OWNER, User::ROLE_ADMIN]),
        ];
    }
}
