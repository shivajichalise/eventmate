<?php

use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

// Used by organizers
Route::middleware('auth:organizer')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::resource('results', ResultController::class);
    });
});
