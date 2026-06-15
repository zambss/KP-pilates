<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomerAuth
{
      protected function redirectTo($request): ?string
    {
        if (! $request->expectsJson()) {
            return route('home', ['login' => 1]);
        }

        return null;
    }
}