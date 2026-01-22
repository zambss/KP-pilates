<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'index'])->name('home');

Route::get('/event', fn () => view('event'));
Route::get('/fasilitas', fn () => view('fasilitas'));
Route::get('/coach', fn () => view('coach'));
Route::get('/faq', fn () => view('faq'));
Route::get('/contact', fn () => view('contact'));


/*
|--------------------------------------------------------------------------
| AUTH (JANGAN DIUBAH)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'registerProcess']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| DASHBOARD (SETELAH LOGIN)
|--------------------------------------------------------------------------
| SEMUA PAGE DASHBOARD ADA DI FOLDER:
| resources/views/dashboardLogin/
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('dashboard')->group(function () {

    // DASHBOARD HOME
    Route::get('/', [DashboardController::class, 'loin'])
        ->name('dashboardLogin.index');

    // KALENDER DASHBOARD
Route::get('/calendar', [DashboardController::class, 'calendar'])
    ->name('dashboardLogin.calendar');


    // PAGE PILIH JADWAL (KALENDER KHUSUS)
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


/*
|--------------------------------------------------------------------------
| LOG OUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/'); // balik ke landing page
})->name('logout');