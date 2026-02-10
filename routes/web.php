<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\RoomSearchController;
use App\Http\Controllers\Guest\BookingController;
use App\Http\Controllers\Guest\MyBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoomTypeController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\GuestController;
use App\Http\Controllers\Admin\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest/Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rooms', [RoomSearchController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{id}', [RoomSearchController::class, 'show'])->name('rooms.show');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated Guest Routes
Route::middleware('auth')->group(function () {
    Route::get('/booking/{roomType}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/success/{bookingCode}', [BookingController::class, 'success'])->name('booking.success');
    
    Route::get('/my-bookings', [MyBookingController::class, 'index'])->name('my-bookings.index');
    Route::get('/my-bookings/{bookingCode}', [MyBookingController::class, 'show'])->name('my-bookings.show');
    Route::post('/my-bookings/{bookingCode}/cancel', [MyBookingController::class, 'cancel'])->name('my-bookings.cancel');
});

// Admin Routes
Route::middleware(['auth', 'role:admin,receptionist'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('room-types', RoomTypeController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('reservations', ReservationController::class)->except(['create', 'store']);
    Route::post('/reservations/{reservation}/checkin', [ReservationController::class, 'checkin'])->name('reservations.checkin');
    Route::post('/reservations/{reservation}/checkout', [ReservationController::class, 'checkout'])->name('reservations.checkout');
    
    Route::get('/guests', [GuestController::class, 'index'])->name('guests.index');
    Route::get('/guests/{guest}', [GuestController::class, 'show'])->name('guests.show');
    Route::delete('/guests/{guest}', [GuestController::class, 'destroy'])->name('guests.destroy');
    
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{payment}', [PaymentController::class, 'show'])->name('payments.show');
    Route::put('/payments/{payment}', [PaymentController::class, 'update'])->name('payments.update');
});
