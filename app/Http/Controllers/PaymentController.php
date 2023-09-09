<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function index()
    {
    }

    public function buy(Ticket $ticket)
    {
        $event = $ticket->event;
        $subevent = $ticket->subEvent;
        $event = $subevent->event;
        $user = Auth::user();

        $amounts = [
            'price' => $ticket->price,
            'subTotal' => $ticket->price,
            'tax' => ($ticket->tax / 100) * $ticket->price,
            'total' => (($ticket->tax / 100) * $ticket->price) + $ticket->price,
        ];

        return Inertia::render('Payment/Invoice', [
            'user' => $user,
            'event' => $event,
            'sub_event' => $subevent,
            'ticket' => $ticket,
            'amounts' => $amounts
        ]);
    }
}
