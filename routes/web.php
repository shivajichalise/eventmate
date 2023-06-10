<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
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
    Route::middleware('guest:organizer')->group(function () {
        Route::get('/register', [OrganizerController::class, 'register']);
        Route::get('/login', [OrganizerController::class, 'login'])->name('login');
        Route::post('/register', [OrganizerController::class, 'signup']);
        Route::post('/login', [OrganizerController::class, 'authenticate']);
    });

    Route::middleware('auth:organizer')->group(function () {
        Route::post('/logout', [OrganizerController::class, 'logout']);

        Route::middleware('verified')->group(function () {
            Route::get('/', [OrganizerController::class, 'index']);
        });

        Route::get('/email/verify', [EmailVerificationController::class, 'verifyEmail'])->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verifyEmailRequest'])->middleware(['signed'])->name('verification.verify');
        Route::post('/email/verification-notification', [EmailVerificationController::class, 'verifyEmailResend'])->middleware(['throttle:2,1'])->name('verification.resend');
    });
});

// Event Routes
Route::resource('events', EventController::class);

Route::prefix('/events/create')->name('events.')->group(function () {
    Route::get('/{step}', [EventController::class, 'form'])->name('form');
    Route::post('/general', [EventController::class, 'saveGeneral'])->name('general.save');
    Route::post('/sub-events', [EventController::class, 'saveSubEvent'])->name('sub_events.save');
    Route::post('/tickets', [EventController::class, 'saveTicket'])->name('tickets.save');
    Route::post('/support', [EventController::class, 'saveSupport'])->name('support.save');
});


require __DIR__.'/auth.php';
