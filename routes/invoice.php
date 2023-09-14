<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// Used by Users
Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::prefix('/invoices')->name('invoice.')->group(function () {
            Route::get('/download/{id}', [InvoiceController::class, 'download'])->name('download');
        });
    });
});
