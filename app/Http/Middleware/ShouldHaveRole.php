<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class ShouldHaveRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next (\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param mixed ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (in_array("anonymous", $roles) && !auth()->check()) {
            return $next($request);
        }

        if (auth()->check()) {
            if (in_array(auth()->user()->role, $roles)) {
                return $next($request);
            }
        }

        abort(404);
    }
}
