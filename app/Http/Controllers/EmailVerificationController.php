<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationController extends Controller
{
    public function verifyEmail()
    {
        return view('auth.verify');
    }

    public function verifyEmailRequest(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();
        return redirect(RouteServiceProvider::ORGANIZER);

    }

    public function verifyEmailResend(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
