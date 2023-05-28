<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrganizerController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(): RedirectResponse
    {
        return redirect('/dashboard');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function signup(): RedirectResponse
    {
        return redirect('/login');
    }
}
