<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\{
    Hero,
    Event,
    Package,
    About,
    Facility,
    Coach
};

class DashboardController extends Controller
{
    /* =====================
       PUBLIC HOME (LANDING)
       → untuk /
    ====================== */
    public function home()
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

    /* =====================
       DASHBOARD HOME (LOGIN)
       → untuk /dashboard
    ====================== */
    public function index()
    {
        // dummy class booking (sementara)
        $classes = [
            (object) [
                'title'  => 'Reformer Pilates',
                'coach'  => 'Jessica Lee',
                'date'   => '10 Jan 2026',
                'time'   => '09:00 - 10:00',
                'status' => 'confirmed',
            ],
            (object) [
                'title'  => 'Mat Pilates',
                'coach'  => 'Amanda Wong',
                'date'   => '12 Jan 2026',
                'time'   => '10:30 - 11:30',
                'status' => 'pending',
            ],
        ];

        return view('dashboardLogin.index', compact('classes'));
    }

    /* =====================
       DASHBOARD CALENDAR
    ====================== */
    public function calendar(Request $request)
    {
        $currentDate = $request->get('date')
            ? Carbon::parse($request->get('date'))
            : Carbon::now();

        $startOfWeek = $currentDate
            ->copy()
            ->startOfWeek(Carbon::SUNDAY);

        $days = collect();

        for ($i = 0; $i < 7; $i++) {
            $days->push(
                $startOfWeek->copy()->addDays($i)
            );
        }

        return view(
            'dashboardLogin.calendar',
            compact('days', 'currentDate')
        );
    }

    /* =====================
       DASHBOARD SUB PAGE
    ====================== */
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