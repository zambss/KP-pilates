<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dummy login
        $request->validate([
            'name' => 'required'
        ]);

        session([
            'user_name' => $request->name
        ]);

        return redirect()->route('home');
    }
}