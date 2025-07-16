<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('tasklist')->name('tasklist')->group(function () {

    Route::prefix('projects')->controller(ProjectController::class)->name('project.')->group(function () {
        Route::get('/', 'index');
        Route::get('/add', 'add');
        Route::post('/create', 'create');
        Route::get('/edit/{id}', 'edit');
        Route::post('/update', 'update');
        Route::post('/delete', 'delete');
    });
});
