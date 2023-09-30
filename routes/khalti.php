<?php

use App\Http\Controllers\KhaltiController;
use Illuminate\Support\Facades\Route;

// Used by Users
Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::prefix('/khalti')->name('khalti.')->group(function () {
            Route::get('/pay/{invoice}', [KhaltiController::class, 'pay'])->name('pay');
            Route::get('/verify/', [KhaltiController::class, 'verify'])->name('verify');
        });
    });
});
