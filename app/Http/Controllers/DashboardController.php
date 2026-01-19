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
}