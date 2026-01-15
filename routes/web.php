<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViewController\Home\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/',[HomeController::class,"home"])->name("home");
Route::get('/personal-order',[HomeController::class,"personal_order"])->name("personal-order");
Route::get('/event-order',[HomeController::class,"event_order"])->name("event-order");

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
