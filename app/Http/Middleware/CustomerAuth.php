<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('user_name')) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}