<?php

use App\Http\Controllers\musicController;
use Illuminate\Support\Facades\Route;

Route::controller(musicController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/add-new-music', 'addMusic')->name('addMusic');
    Route::get('/detail-music/{id}', 'show')->name('show');
    Route::get('/delete-music/{id}', 'delete')->name('delete');

    Route::post('/insert-music', 'store')->name('store');
    Route::post('/edit-music/{id}', 'update')->name('update');
});
