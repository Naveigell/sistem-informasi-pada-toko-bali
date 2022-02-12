<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect(route('index'));
        }

        // if credentials doesn't match, and just return email input
        return back()->withErrors([
            "system" => trans('auth.failed'),
        ])->withInput($request->only('email'));
    }
}
