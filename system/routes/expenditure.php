<?php

use App\Http\Controllers\ExpenditureController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('expenditures')->name('expenditures')->group(function () {
    Route::controller(ExpenditureController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/add', 'add');
        Route::post('/create', 'create');
        Route::get('/edit/{id}', 'edit');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
    });
});
