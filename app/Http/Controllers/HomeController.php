<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        $payments = null;
        if(Auth::check()) {
            $payments =  Auth::user()->ticketsWithPayments();
        }

        $events = Event::ongoing()->with(['subEvents.ticket', 'venue'])->get();

        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'events' => $events,
            'payments' => $payments
        ]);
    }

    public function dashboard(): Response
    {
        return Inertia::render('Dashboard');
    }

    public function listPurchasedTickets()
    {
        $purchasedTickets =  Auth::user()->purchasedTickets();
        // return $purchasedTickets;
        return Inertia::render('MyTickets', [
            'purchasedTickets' => $purchasedTickets
        ]);
    }
}
