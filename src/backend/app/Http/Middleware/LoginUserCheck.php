<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginUserCheck
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return $next($request);
        } else {
            return redirect(route('login'));
        }
    }
}
