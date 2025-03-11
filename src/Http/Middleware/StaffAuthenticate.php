<?php

namespace Darvis\Manta\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffAuthenticate extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        if (!Auth::guard('staff')->check()) {
            return redirect()->route('staff.login');
        }

        return $request;
    }

    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('staff.login');
    }
}
