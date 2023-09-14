<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::middleware('verified', 'roleCheck')->group(function () {
        Route::prefix('/tickets')->name('tickets.')->group(function () {
            Route::get('/', [HomeController::class, 'listPurchasedTickets'])->name('list');
            Route::get('/buy/{ticket}', [PaymentController::class, 'buy'])->name('buy')->middleware('paymentCheck');
        });
    });
});
