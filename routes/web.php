<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// routes/web.php
Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/calendar', fn () => view('calendar'))
        ->name('calendar');

    Route::get('/card', fn () => view('card'))
        ->name('card');

    Route::get('/package', fn () => view('package'))
        ->name('package');

    Route::get('/notification', fn () => view('notification'))
        ->name('notification');

    Route::get('/profile', fn () => view('profile'))
        ->name('profile');


Route::get('/fasilitas', function () {
    return view('fasilitas');
});

Route::get('/coach', function () {
    return view('coach');
});

Route::get('/event', function () {
    return view('event');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/contact', function () {
    return view('contact');
});




/*Route::get('/join-class', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');*/



    Route::middleware('auth')->group(function () {
    Route::get('/dashboardLogin/index', [DashboardController::class, 'loin'])
        ->name('dashboardLogin.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerProcess']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');