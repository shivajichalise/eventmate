<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceiptRequest;
use App\Http\Requests\UpdateReceiptRequest;
use App\Models\Invoice;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Spipu\Html2Pdf\Html2Pdf;

class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 's';
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function generate($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);

        $user = $invoice->user;
        $ticket = $invoice->ticket;
        $subEvent = $ticket->subEvent;
        $event = $subEvent->event;

        $date = Carbon::now()->format('F d, Y');

        // Get the HTML content of the view
        $html = View::make('emails.receipt', [
            'date' => $date,
            'invoice' => $invoice,
            'user' => $user,
            'event' => $event,
            'subEvent' => $subEvent,
            'ticket' => $ticket,
        ])->render();

        // Create an instance of Html2Pdf
        $pdf = new Html2Pdf();

        // Set the PDF content
        $pdf->writeHTML($html);

        // Output the PDF file
        $name = $invoice->number;

        $pdf->output(public_path('receipts/'. $name . '.pdf'), 'F');
    }


    /**
         * Store a newly created resource in storage.
         */
    public function store(StoreReceiptRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReceiptRequest $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
