<?php

use Illuminate\Support\Facades\Route;

// routes/web.php
Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/calendar', [DashboardController::class, 'calendar']);
    Route::get('/dashboard/my-card', [DashboardController::class, 'card']);
    Route::get('/dashboard/packages', [DashboardController::class, 'packages']);
    Route::get('/dashboard/notifications', [DashboardController::class, 'notifications']);
    Route::get('/dashboard/profile', [DashboardController::class, 'profile']);
});

Route::get('/dev-dashboard', function () {
    return view('dashboard');
});