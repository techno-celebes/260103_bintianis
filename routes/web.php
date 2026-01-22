<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViewController\Home\HomeController;
use App\Http\Controllers\BookingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/home', function () {
    return view('home');
})->middleware('auth.custom')->name('home');

Route::get('/',[HomeController::class,"home"])->name("landing");

Route::get('/',[HomeController::class,"home"])->name("home");
Route::get('/personal-order',[HomeController::class,"personal_order"])->name("personal-order");
Route::get('/event-order',[HomeController::class,"event_order"])->name("event-order");

// Booking routes
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('booking.show');

Route::middleware('auth')->group(function () {
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('booking.myBookings');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('admin.dashboard');
    Route::get('/bookings', [BookingController::class, 'index'])->name('booking.index');
    Route::patch('/booking/{booking}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
