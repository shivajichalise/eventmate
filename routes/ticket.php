<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::prefix('/tickets')->name('tickets.')->group(function () {
            Route::get('/buy/{ticket}', [PaymentController::class, 'buy'])->name('buy');
        });
    });
});
