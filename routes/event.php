<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

// Used by organizers
Route::middleware('auth:organizer')->group(function () {
    Route::middleware('verified')->group(function () {
        Route::get('/events/discard', [EventController::class, 'discard'])->name('events.discard');

        Route::prefix('/events/create')->name('events.')->group(function () {
            Route::get('/{step}', [EventController::class, 'form'])->name('form');
            Route::post('/general', [EventController::class, 'saveGeneral'])->name('general.save');

            Route::prefix('/sub-events')->name('sub_events.')->group(function () {
                Route::post('/', [EventController::class, 'saveSubEvent'])->name('save');
                Route::delete('/{subEvent}', [EventController::class, 'destroySubEvent'])->name('destroy');
            });

            Route::prefix('/tickets')->name('tickets.')->group(function () {
                Route::post('/', [EventController::class, 'saveTicket'])->name('save');
                Route::delete('/{ticket}', [EventController::class, 'destroyTicket'])->name('destroy');
            });

            Route::post('/support', [EventController::class, 'saveSupport'])->name('support.save');

            Route::post('/toggle', [EventController::class, 'toggleStatus'])->name('toggle');
        });

        Route::prefix('/events/{event}/edit')->name('events.edit.')->group(function () {
            Route::get('/{step}', [EventController::class, 'editForm'])->name('form');
            Route::put('/general', [EventController::class, 'saveGeneral'])->name('general');

            Route::put('/support', [EventController::class, 'saveSupport'])->name('support');
        });

        Route::resource('events', EventController::class);
    });
});

// Used by users
Route::prefix('/event')->name('event.')->group(function () {
    Route::get('/{event}', [EventController::class, 'view'])->name('view');
});
