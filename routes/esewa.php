<?php

use App\Http\Controllers\EsewaController;
use Illuminate\Support\Facades\Route;

// Used by Users
Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::prefix('/esewa')->name('esewa.')->group(function () {
            Route::post('/pay', [EsewaController::class, 'pay'])->name('pay');
            Route::get('/verify', [EsewaController::class, 'verify']);
        });
    });
});
