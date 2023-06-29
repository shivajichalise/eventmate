<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function buy()
    {
        return Inertia::render('Payment/Invoice');
    }
}
