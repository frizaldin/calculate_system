<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::prefix('wishlist')->name('wishlist')->middleware('auth')->group(function () {
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
});
