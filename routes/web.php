<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WishlistController;
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

    // Category routes
    Route::prefix('categories')->controller(CategoryController::class)->name('category.')->group(function () {
        Route::get('/', 'index');
        Route::get('/add', 'add');
        Route::post('/create', 'create');
        Route::get('/edit/{id}', 'edit');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
    });

    // Wishlist routes
    Route::prefix('wishlists')->controller(WishlistController::class)->name('wishlist.')->group(function () {
        Route::get('/', 'index');
        Route::get('/add', 'add');
        Route::post('/create', 'create');
        Route::get('/edit/{id}', 'edit');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
