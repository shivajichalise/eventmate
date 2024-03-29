<?php

use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::prefix('/results')->name('results.')->group(function () {
            Route::get('/download/{result}', [ResultController::class, 'download'])->name('download');
        });
    });
});

// Used by organizers
Route::middleware('auth:organizer')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::prefix('/results')->name('results.')->group(function () {
            Route::get('/{result}/download', [ResultController::class, 'download'])->name('download');
        });
        Route::resource('results', ResultController::class);
    });
});
