<?php

use App\Http\Controllers\RoleAndPermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:organizer')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::group(['middleware' => ['role:super-organizer']], function () {
            Route::resource('roles', RoleAndPermissionController::class);
        });
    });
});
