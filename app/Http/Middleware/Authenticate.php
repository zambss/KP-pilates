<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        // 🔥 belum login → ke home + modal login
        if (! $request->expectsJson()) {
            return route('home', ['login' => 1]);
        }

        return null;
    }

    public function handle($request, \Closure $next, ...$guards)
    {
        // 🔥 CEK LOGIN DULU (bawaan)
        if (!Auth::check()) {
            return redirect()->route('home', ['login' => 1]);
        }

        // 🔥 ADMIN AREA
        if ($request->is('admin') || $request->is('admin/*')) {

            if (!in_array(Auth::user()->role, ['admin', 'super_admin'])) {
                abort(403, 'Akses ditolak');
            }
        }

        return $next($request);
    }
}