<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

// Used by organizers
Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::get('/buy', [PaymentController::class, 'buy']);
    });
});
