<?php

use App\Http\Controllers\MonthlyFinanceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('monthly_finances')->name('monthly_finances')->group(function () {

    Route::controller(MonthlyFinanceController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/add', 'add');
        Route::post('/create', 'create');
        Route::get('/edit/{id}', 'edit');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
    });
});
