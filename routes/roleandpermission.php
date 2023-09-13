<?php

use App\Http\Controllers\RoleAndPermissionController;
use Illuminate\Support\Facades\Route;

Route::resource('roles', RoleAndPermissionController::class);
Route::middleware('auth:organizer')->group(function () {
    Route::middleware('verified')->group(function () {
    });
});
