<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Rute login
Route::get('/login', [LoginController::class, 'showLoginForm'])
    ->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Rute logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Rute yang memerlukan autentikasi
Route::group(['middleware' => 'auth'], function () {
    // Rute yang hanya dapat diakses oleh pengguna yang telah login
    Route::get('/dashboard', [HomeController::class, 'dashboard'])
        ->name('dashboard');

    // Rute lain yang memerlukan autentikasi
    Route::get('/profile', [HomeController::class, 'profile'])
        ->name('profile');
});