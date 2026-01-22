<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| LANDING PAGE (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/', [DashboardController::class, 'home'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])
    ->name('login');

Route::post('/login', [AuthController::class, 'loginProcess']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD (SETELAH LOGIN)
|--------------------------------------------------------------------------
| Semua view ada di: resources/views/dashboardLogin/
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('dashboard')->group(function () {

    // ✅ DASHBOARD HOME (BENAR)
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboardLogin.index');

    // KALENDER
    Route::get('/calendar', [DashboardController::class, 'calendar'])
        ->name('dashboardLogin.calendar');

    // PILIH JADWAL
    Route::get('/schedule', function () {
        return view('dashboardLogin.schedule');
    })->name('dashboard.schedule');

    // CARD SAYA
    Route::get('/card', function () {
        return view('dashboardLogin.my-card');
    })->name('dashboardLogin.my-card');

    // PAKET PILATES
    Route::get('/package', function () {
        return view('dashboardLogin.packages');
    })->name('dashboardLogin.package');

    // NOTIFIKASI
    Route::get('/notification', function () {
        return view('dashboardLogin.notifications');
    })->name('dashboardLogin.notifications');

    // PROFILE
    Route::get('/profile', function () {
        return view('dashboardLogin.profile');
    })->name('dashboardLogin.profile');

});