<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\Invoices\Invoice as LaravelInvoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class InvoiceController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
    }

    public function download($id)
    {
        $invoice = Invoice::find($id);

        $user = $invoice->user;
        $ticket = $invoice->ticket;
        $subEvent = $ticket->subEvent;
        $event = $subEvent->event;

        $user = Auth::user();

        $client = new Party([
            'name'          => config('app.name'),
            'phone'         => $event->support->mobile,
            'email'         => $event->support->email,
        ]);

        $customer = new Party([
            'name'          => $user->name,
            'address'       => $user->address,
            'code'          => $user->id,
        ]);

        $item = (new InvoiceItem())->title($subEvent->name)->pricePerUnit($ticket->price);

        $invoice = LaravelInvoice::make()
        ->series($invoice->number)
        ->sequence(explode('-', $invoice->number)[2])
        ->serialNumberFormat('{SERIES}')
        ->seller($client)
        ->buyer($customer)
        // ->discountByPercent(10)
        ->taxRate($ticket->tax)
        ->currencySymbol('₹')
        ->currencyCode('NPR')
        // ->shipping(1.99)
        ->addItem($item)
        ->logo(public_path('images/logo.png'));

        // And return invoice itself to browser or have a different view
        return $invoice->download();
    }
}
