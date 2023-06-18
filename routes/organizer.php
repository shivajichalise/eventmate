<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Route;

// Organizer Routes
Route::prefix('/organizers')->name('organizers.')->group(function () {
    Route::middleware('guest:organizer')->group(function () {
        Route::get('/register', [OrganizerController::class, 'register'])->name('register');
        Route::get('/login', [OrganizerController::class, 'login'])->name('login');
        Route::post('/register', [OrganizerController::class, 'signup']);
        Route::post('/login', [OrganizerController::class, 'authenticate']);
    });

    Route::middleware('auth:organizer')->group(function () {
        Route::post('/logout', [OrganizerController::class, 'logout']);

        Route::middleware('verified')->group(function () {
            Route::get('/', [OrganizerController::class, 'index'])->name('dashboard');
        });

        Route::get('/email/verify', [EmailVerificationController::class, 'verifyEmail'])->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verifyEmailRequest'])->middleware(['signed'])->name('verification.verify');
        Route::post('/email/verification-notification', [EmailVerificationController::class, 'verifyEmailResend'])->middleware(['throttle:2,1'])->name('verification.resend');
    });
});
