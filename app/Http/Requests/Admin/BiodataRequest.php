<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BiodataRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            "name"     => "required|string|min:5|max:255",
            "username" => "required|string|min:5|max:255|unique:users",
            "email"    => "required|string|min:5|max:255|unique:users",
        ];

        // if the username or email is same with current username and email
        // forget about unique rules
        if ($this->get('username') === auth()->user()->username) {
            $rules['username'] = "required|string|max:255";
        }

        if ($this->get('email') === auth()->user()->email) {
            $rules['email'] = "required|string|max:255";
        }

        return $rules;
    }
}
