<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\vendor\Chatify\MessagesController;


class CustomAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() || Auth::guard('student')->check()) {
            return $next($request);
        }

        return redirect('/');
    }
}