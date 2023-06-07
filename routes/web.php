<?php

use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Organizer Routes
Route::prefix('/organizers')->name('organizers.')->group(function () {
    Route::get('/register', [OrganizerController::class, 'register']);
    Route::get('/login', [OrganizerController::class, 'login']);
    Route::post('/register', [OrganizerController::class, 'signup']);
    Route::post('/login', [OrganizerController::class, 'authenticate']);
    Route::post('/logout', [OrganizerController::class, 'logout']);

    Route::middleware('organizer')->group(function () {
        Route::get('/', [OrganizerController::class, 'index']);
    });
});


require __DIR__.'/auth.php';
