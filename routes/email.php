<?php

use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:organizer')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::group(['middleware' => ['role:super-organizer']], function () {
            Route::prefix('send-emails')->name('send_emails.')->group(function () {
                Route::get('/', [EmailController::class, 'index'])->name('index');
                Route::get('/ask-to-participate', [EmailController::class, 'askToParticipate'])->name('participate')->middleware('throttle:1,1440');
                Route::get('/remainder', [EmailController::class, 'remainder'])->name('remainder')->middleware('throttle:1,1440');
            });
        });
    });
});
