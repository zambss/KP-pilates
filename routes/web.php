<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('home');
})->name('home');

// routes/web.php
Route::get('/', [DashboardController::class, 'index'])->name('home');


Route::middleware('customer.auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

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
    Route::get('/member/dashboard', [DashboardController::class, 'index'])
        ->name('dashboardLogin.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerProcess']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');