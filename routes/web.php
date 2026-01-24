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

/*
|--------------------------------------------------------------------------
| REGISTER (MODAL BASED)
|--------------------------------------------------------------------------
| Register tidak punya halaman GET
| Digunakan oleh modal (POST only)
*/
Route::post('/register', [AuthController::class, 'registerProcess'])
    ->name('register.process');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout');

Route::get('/register', function () {
    return redirect('/')->with('openRegister', true);
});



/*
|--------------------------------------------------------------------------
| DASHBOARD (SETELAH LOGIN)
|--------------------------------------------------------------------------
| Semua view ada di: resources/views/dashboardLogin/
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('dashboard')->group(function () {

    // DASHBOARD HOME
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboardLogin.index');

    Route::get('/dashboard/transactions', function () {
        return view('dashboardLogin.transaksi');
    })->name('dashboardLogin.transaksi');

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


/*
|--------------------------------------------------------------------------
| FORMULIR & KONFIRMASI KELAS
|--------------------------------------------------------------------------
*/

// KONFIRMASI PENDAFTARAN KELAS (HTML PAGE)
Route::post('/class/confirm', function () {
    return view('schedule.confirm');
})->name('class.confirm');



//booking kelas
Route::get('/booking/{class}', [bookingController::class, 'form'])
    ->middleware('auth')
    ->name('booking.form');

    Route::post('/booking/confirm', [bookingController::class, 'confirm'])
    ->middleware('auth')
    ->name('booking.confirm');
    
    Route::post('/booking/store', [bookingController::class, 'store'])
    ->middleware('auth')
    ->name('booking.store');

    Route::get('/booking/receipt/{transaction}', [bookingController::class, 'receipt'])
    ->middleware('auth')
    ->name('booking.receipt');