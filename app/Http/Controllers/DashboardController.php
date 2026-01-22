<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
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

public function calendar(Request $request)
{
    $currentDate = $request->get('date')
        ? Carbon::parse($request->get('date'))
        : Carbon::now();

    $startOfWeek = $currentDate->copy()->startOfWeek(Carbon::SUNDAY);

    $days = collect();

    for ($i = 0; $i < 7; $i++) {
        $days->push($startOfWeek->copy()->addDays($i));
    }

    return view('dashboardLogin.calendar', compact('days', 'currentDate'));
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