<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('dashboard.index', compact('user'));
    }

    public function calendar()
    {
        return view('dashboard.calendar');
    }

    public function card()
    {
        return view('dashboard.my-card');
    }

    public function packages()
    {
        return view('dashboard.packages');
    }

    public function notifications()
    {
        return view('dashboard.notifications');
    }

    public function profile()
    {
        return view('dashboard.profile');
    }
}