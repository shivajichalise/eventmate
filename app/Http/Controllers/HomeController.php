<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $events = Event::ongoing()->with('subEvents.ticket')->get();
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'events' => $events
        ]);
    }

    public function dashboard(): Response
    {
        return Inertia::render('Dashboard');
    }
}
