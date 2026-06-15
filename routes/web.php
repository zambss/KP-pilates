<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\HeroController;
use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\FacilityController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\ClassOrderController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| LANDING PAGE (PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [DashboardController::class, 'home'])
    ->name('home');





Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::get('/', [UserController::class, 'dashboard'])
        ->name('admin.dashboard');
Route::resource('facility', FacilityController::class)->names('admin.facility');
Route::resource('hero', HeroController::class)->names('admin.hero');
    Route::resource('about', AboutController::class)->names('admin.about');
    Route::resource('users', UserController::class);

    Route::get('/classes', [UserController::class, 'classes'])->name('classes.index');
    Route::get('/classes/create', [UserController::class, 'createClass'])->name('classes.create');
    Route::post('/classes', [UserController::class, 'storeClass'])->name('classes.storee');
    Route::get('/classes/{id}/edit', [UserController::class, 'editClass'])->name('classes.edit');
    Route::put('/classes/{id}', [UserController::class, 'updateClass'])->name('classes.update');
    Route::delete('/classes/{id}', [UserController::class, 'deleteClass'])->name('classes.delete');

    // MEMBERSHIP
    Route::get('/memberships', [UserController::class, 'memberships'])->name('memberships.index');
    Route::get('/memberships/create', [UserController::class, 'createMembership'])->name('memberships.create');
    Route::post('/memberships', [UserController::class, 'storeMembership'])->name('memberships.store');
    Route::delete('/memberships/{id}', [UserController::class, 'deleteMembership'])->name('memberships.delete');
    Route::get('/memberships/{id}/edit', [UserController::class, 'editMembership'])->name('memberships.edit');
    Route::put('/memberships/{id}', [UserController::class, 'updateMembership'])->name('memberships.update');

    Route::get('/bookings', [UserController::class, 'bookings'])->name('bookings.index');
    Route::get('/bookings/create', [UserController::class, 'createBooking'])->name('bookings.create');
    Route::post('/bookings', [UserController::class, 'storeBooking'])->name('bookings.store');
    Route::get('/bookings/{id}/edit', [UserController::class, 'editBooking'])->name('bookings.edit');
    Route::put('/bookings/{id}', [UserController::class, 'updateBooking'])->name('bookings.update');
    Route::delete('/bookings/{id}', [UserController::class, 'deleteBooking'])->name('bookings.delete');

    Route::get('/orders', [UserController::class, 'orders'])->name('orders.index');
    Route::get('/orders/create', [UserController::class, 'createOrder'])->name('orders.create');
    Route::post('/orders', [UserController::class, 'storeOrder'])->name('orders.store');
    Route::post('/orders/{id}/approve', [UserController::class, 'approveOrder'])->name('orders.approve');
Route::post('/orders/{id}/reject', [UserController::class, 'rejectOrder'])->name('orders.reject');
    Route::get('/orders/{id}/edit', [UserController::class, 'editOrder'])->name('orders.edit');
    Route::put('/orders/{id}', [UserController::class, 'updateOrder'])->name('orders.update');
    Route::delete('/orders/{id}', [UserController::class, 'deleteOrder'])->name('orders.delete');

    Route::get('/prices', [UserController::class, 'prices'])->name('prices.index');
    Route::get('/prices/create', [UserController::class, 'createPrice'])->name('prices.create');
    Route::post('/prices', [UserController::class, 'storePrice'])->name('prices.store');
    Route::get('/prices/{id}/edit', [UserController::class, 'editPrice'])->name('prices.edit');
    Route::put('/prices/{id}', [UserController::class, 'updatePrice'])->name('prices.update');
    Route::delete('/prices/{id}', [UserController::class, 'deletePrice'])->name('prices.delete');

    Route::get('/coaches', [UserController::class, 'coaches'])->name('coaches.index');
    Route::get('/coaches/create', [UserController::class, 'createCoach'])->name('coaches.create');
    Route::post('/coaches', [UserController::class, 'storeCoach'])->name('coaches.store');
    Route::get('/coaches/{id}/edit', [UserController::class, 'editCoach'])->name('coaches.edit');
    Route::put('/coaches/{id}', [UserController::class, 'updateCoach'])->name('coaches.update');
    Route::delete('/coaches/{id}', [UserController::class, 'deleteCoach'])->name('coaches.delete');

    Route::get('/package-items', [UserController::class, 'packageItems'])->name('package-items.index');
    Route::get('/package-items/create', [UserController::class, 'createPackageItem'])->name('package-items.create');
    Route::post('/package-items', [UserController::class, 'storePackageItem'])->name('package-items.store');
    Route::get('/package-items/{id}/edit', [UserController::class, 'editPackageItem'])->name('package-items.edit');
    Route::put('/package-items/{id}', [UserController::class, 'updatePackageItem'])->name('package-items.update');
    Route::delete('/package-items/{id}', [UserController::class, 'deletePackageItem'])->name('package-items.delete');

    Route::get('/package-orders', [UserController::class, 'packageOrders'])->name('package-orders.index');
    Route::post('/package-orders/{id}/approve', [UserController::class, 'approvePackageOrder'])->name('package-orders.approve');
    Route::post('/package-orders/{id}/reject', [UserController::class, 'rejectPackageOrder'])->name('package-orders.reject');
    
    Route::get('/packages', [UserController::class, 'packages'])->name('packages.index');
    Route::get('/packages/create', [UserController::class, 'createPackage'])->name('packages.create');
    Route::post('/packages', [UserController::class, 'storePackage'])->name('packages.store');
    Route::get('/packages/{id}/edit', [UserController::class, 'editPackage'])->name('packages.edit');
    Route::put('/packages/{id}', [UserController::class, 'updatePackage'])->name('packages.update');
    Route::delete('/packages/{id}', [UserController::class, 'deletePackage'])->name('packages.delete');

    Route::get('/profiles', [UserController::class, 'userProfiles'])->name('profiles.index');
    Route::get('/profiles/create', [UserController::class, 'createUserProfile'])->name('profiles.create');
    Route::post('/profiles', [UserController::class, 'storeUserProfile'])->name('profiles.store');
    Route::get('/profiles/{id}/edit', [UserController::class, 'editUserProfile'])->name('profiles.edit');
    Route::put('/profiles/{id}', [UserController::class, 'updateUserProfile'])->name('profiles.update');
    Route::delete('/profiles/{id}', [UserController::class, 'deleteUserProfile'])->name('profiles.delete');
    
     Route::get('/attendances', [UserController::class, 'attendances'])
        ->name('attendances.index');

    // tombol absensi
    Route::post('/attendance/{booking}', [UserController::class, 'doAttendance'])
        ->name('attendance.do');
    Route::get('/schedule', [UserController::class, 'schedule'])
    ->name('admin.schedule');
    // create
    Route::post('/schedule', [UserController::class, 'storeSchedule'])
        ->name('schedule.store');
    Route::get('/schedules', [UserController::class, 'getSchedules']);
    // delete
    Route::delete('/schedule/{id}', [UserController::class, 'deleteSchedule'])
        ->name('schedule.delete');
    });
    Route::patch(
    '/admin/schedule/{id}/toggle',
    [UserController::class, 'toggleSchedule']
    );
    Route::get('/schedule', [UserController::class, 'userSchedule'])
    ->name('user.schedule');
    Route::post(
    '/dashboard/schedule/{id}/booking',
    [DashboardController::class, 'bookingSchedule']
    )->name('dashboard.schedule.booking');
    
    /* ==========================
   STUDIO
========================== */

Route::get(
    '/admin/studio',
    [UserController::class, 'rooms']
)->name('studio.index');



Route::get(
    '/admin/studio/create',
    [UserController::class, 'createRoom']
)->name('studio.create');



Route::post(
    '/admin/studio/store',
    [UserController::class, 'storeRoom']
)->name('studio.store');



Route::get(
    '/admin/studio/{id}/edit',
    [UserController::class, 'editRoom']
)->name('studio.edit');



Route::put(
    '/admin/studio/{id}',
    [UserController::class, 'updateRoom']
)->name('studio.update');



Route::delete(
    '/admin/studio/{id}',
    [UserController::class, 'deleteRoom']
)->name('studio.delete');



Route::post(
    '/admin/schedule/{id}/update-room',
    [UserController::class, 'updateScheduleRoom']
)->name('admin.schedule.update-room');


Route::get('/auth/{provider}', [SocialLoginController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback']);


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
| DASHBOARD 
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('dashboard')
    ->group(function () {

        Route::post('/dashboard/booking/{booking}/cancel', [BookingController::class, 'cancelBooking'])
            ->name('booking.cancel');


        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboardLogin.index');

        Route::get(
            '/classes/{class}/checkout',
            [ClassOrderController::class, 'checkout']
        )
            ->name('classes.checkout');

        Route::post(
            '/classes/{class}/checkout',
            [ClassOrderController::class, 'store']
        )
            ->name('classes.store');

        // KALENDER
        Route::get('/calender', [BookingController::class, 'calendar'])
            ->name('dashbordLogin.calendar');

        Route::get('/calendar', [BookingController::class, 'classes'])
            ->name('dashboardLogin.calendar');

        Route::get('/classes/{class}', [BookingController::class, 'classDetail'])
            ->name('dashboard.classes.detail');


        Route::post('/booking/{id}', [BookingController::class, 'store'])
            ->name('booking.store');

        Route::get('/transactions', [DashboardController::class, 'transaksi'])
            ->name('dashboardLogin.transaksi');

        Route::get('/pricelist', [ClassOrderController::class, 'index'])
            ->name('pricelist.index');

        Route::get(
            '/pricelist/class/{classPrice}',
            [ClassOrderController::class, 'checkoutFromPricelist']
        )->name('pricelist.checkout');

        Route::post(
            '/pricelist/buy/class-price/{classPrice}',
            [ClassOrderController::class, 'storeFromPricelist']
        )->name('pricelist.buy.class');

        Route::post(
            '/pricelist/buy/package/{package}',
            [ClassOrderController::class, 'buyPackage']
        )->name('pricelist.buy.package');

        Route::get(
            '/pricelist/package/{package}',
            [ClassOrderController::class, 'checkoutPackage']
        )->name('pricelist.package.checkout');

        // PILIH JADWAL
        Route::get('/schedule', function () {
            return view('dashboardLogin.schedule');
        })->name('dashboard.schedule');

        // CARD SAYA
        Route::get('/card', [DashboardController::class, 'card'])
            ->name('dashboardLogin.my-card');

        // PAKET PILATES


        // NOTIFIKASI
        Route::get('/notification', [DashboardController::class, 'notification'])
            ->name('dashboardLogin.notifications');

        // PROFILE
        Route::get('/profile', [DashboardController::class, 'profile'])
            ->name('dashboardLogin.profile');
    });
    
    Route::post(
    '/dashboard/profile/avatar',
    [DashboardController::class, 'updateAvatar']
)->name('profile.avatar.update');

Route::get(
    '/admin/payment-settings',
    [UserController::class, 'paymentSettings']
)->name('payment.index');

Route::post(
    '/admin/payment-settings/store',
    [UserController::class, 'storePaymentSetting']
)->name('payment.store');

Route::put(
    '/admin/payment-settings/{id}',
    [UserController::class, 'updatePaymentSetting']
)->name('payment.update');