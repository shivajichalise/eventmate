<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:organizer')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::resource('payments', PaymentController::class);
    });
});
