<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Guest routes (untuk user yang belum login)
Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/signin', 'signin')->name('signin');
        Route::post('/_signin', '_signin')->name('_signin');
    });
});

// Auth routes (untuk user yang sudah login)
Route::middleware('auth')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
