<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Public authentication (register/login) – this mirrors the Breeze/Jetstream
// scaffolding.  Anyone can create an account and log in; future role checks
// can branch on the `role` column we added to users.
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

// simple dashboard/home after authentication
Route::get('/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');

// Admin panel (blade authentication/dashboard)
require __DIR__.'/admin.php';

// Serve the Vue SPA
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');

