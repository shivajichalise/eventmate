<?php

use App\Http\Controllers\ReceiptController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::resource('receipt', ReceiptController::class);
    });
});
