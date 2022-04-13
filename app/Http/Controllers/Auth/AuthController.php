<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->only('email', 'password'))) {

            if (in_array(auth()->user()->role, [User::ROLE_ADMIN])) {
                return redirect(route('admin.dashboard.index'));
            }

            return redirect(route('index'));
        }

        // if credentials doesn't match, and just return email input
        return back()->withErrors([
            "system" => trans('auth.failed'),
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        auth()->logout();

        return redirect(route('index'));
    }

    public function register(RegisterRequest $request)
    {
        $user = User::query()->create($request->validated());

        auth()->login($user);

        return redirect(route('index'));
    }
}
