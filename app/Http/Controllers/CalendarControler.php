<?php

namespace App\Http\Controllers;

class CalendarController extends Controller
{
    use Carbon\Carbon;

public function index(Request $request)
{
    $currentDate = $request->get('date')
        ? Carbon::parse($request->get('date'))
        : Carbon::now();

    $startOfWeek = $currentDate->startOfWeek(Carbon::SUNDAY);

    $days = collect();

    for ($i = 0; $i < 7; $i++) {
        $days->push($startOfWeek->copy()->addDays($i));
    }

    return view('calendar.index', compact('days', 'currentDate'));
}

}