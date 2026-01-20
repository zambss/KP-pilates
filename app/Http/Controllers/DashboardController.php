<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Hero, Event, Package, About, Facility, Coach,
};
class DashboardController extends Controller
{
    public function index()
    {
        return view('home', [
            'hero'       => Hero::first(),  
            'event'      => Event::first(),
            'packages'   => Package::with(['prices', 'benefits'])->get(),
            'about'      => About::first(),
            'facilities' => Facility::all(),
            'coaches'    => Coach::all(),
            
        ]);
    }
    public function loin(){
        return view ('dashboardLogin.index');
    }


    /* =====================
       DASHBOARD (LOGIN)
    ====================== */
    public function dashboard()
    {
        return view('dashboardLogin.index');
    }

    public function calendar()
    {
        return view('dashboardLogin.calendar');
    }

    public function card()
    {
        return view('dashboardLogin.my-card');
    }

    public function package()
    {
        return view('dashboardLogin.packages');
    }

    public function notification()
    {
        return view('dashboardLogin.notifications');
    }

    public function profile()
    {
        return view('dashboardLogin.profile');
    }
}