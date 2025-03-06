<?php

namespace Darvis\Manta\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPasswordChange
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->must_change_password) {
            return redirect(route('website.password.change'));
        }

        return $next($request);
    }
}
