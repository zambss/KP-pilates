<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


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
        
// routes/web.php
Route::get('/', [DashboardController::class, 'index'])->name('home');

    Route::get('/calendar', fn () => view('dashboardLogin.calendar'))
        ->name('dashboardLogin.calendar');

    Route::get('/card', fn () => view('dashboardLogin.card'))
        ->name('dashboardLogin.card');

    Route::get('/package', fn () => view('dashboardLogin.packages'))
        ->name('dashboardLogin.package');

    Route::get('/notification', fn () => view('dashboardLogin.notification'))
        ->name('dashboardLogin.notification');

    Route::get('/profile', fn () => view('dashboardLogin.profile'))
        ->name('dashboardLogin.profile');

});

/* =====================
   DASHBOARD (LOGIN)
===================== */
Route::middleware('auth')->prefix('dashboard')->group(function () {

    Route::get('/', [DashboardController::class, 'dashboard'])
        ->name('dashboardLogin.index');

    Route::get('/calendar', [DashboardController::class, 'calendar'])
        ->name('calendar');

    Route::get('/card', [DashboardController::class, 'card'])
        ->name('card');

    Route::get('/package', [DashboardController::class, 'package'])
        ->name('package');

    Route::get('/notification', [DashboardController::class, 'notification'])
        ->name('notification');

    Route::get('/profile', [DashboardController::class, 'profile'])
        ->name('profile');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerProcess']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');