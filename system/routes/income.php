<?php

use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('incomes')->name('incomes')->group(function () {
    Route::controller(IncomeController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/add', 'add');
        Route::post('/create', 'create');
        Route::get('/edit/{id}', 'edit');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
    });
});
