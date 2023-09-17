<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
        Route::patch('/address', [ProfileController::class, 'updateAddress'])->name('update.address');
        Route::patch('/contact', [ProfileController::class, 'updateContact'])->name('update.contact');
    });
});

// Used by organizers
Route::middleware('auth:organizer')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::prefix('/users')->name('users.')->group(function () {

            Route::group(['middleware' => ['role:super-organizer']], function () {
                Route::prefix('/{user}/edit')->group(function () {
                    Route::get('/{step}', [UserController::class, 'editForm'])->name('editForm');
                    Route::put('/profile', [UserController::class, 'updateUserProfileInfo'])->name('profile.update');
                    Route::put('/address', [UserController::class, 'updateUserAddressInfo'])->name('address.update');
                    Route::put('/contact', [UserController::class, 'updateUserContactInfo'])->name('contact.update');
                });

                Route::get('/create', [UserController::class, 'create'])->name('create');
                Route::post('/', [UserController::class, 'store'])->name('store');
                Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
                Route::put('/{user}', [UserController::class, 'update'])->name('update');
                Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
            });

            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/{user}', [UserController::class, 'show'])->name('show');

            // Route::resource('users', UserController::class);
        });
    });
});
