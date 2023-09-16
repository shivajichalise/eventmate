<?php

namespace App\Http\Controllers;

use App\Http\Requests\Organizer\OrganizerPasswordUpdateRequest;
use App\Http\Requests\Organizer\OrganizerProfileUpdateRequest;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\Payment;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use DateTime;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class OrganizerController extends Controller
{
    public function index()
    {
        $totalEvents = Event::count();
        $totalUsers = User::count();
        $totalTicketsSold = Payment::count();
        $totalRevenue = Payment::revenue();

        $lineChart = ChartController::lineChart();
        $barChart = ChartController::barChart();

        return view('dashboard')->with([
            'totalEvents' => $totalEvents,
            'totalUsers' => $totalUsers,
            'totalTicketsSold' => $totalTicketsSold,
            'totalRevenue' => $totalRevenue,
            'barChart' => $barChart,
            'lineChart' => $lineChart,
        ]);
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('organizer')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::ORGANIZER);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function signup(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.Organizer::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $organizer = Organizer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($organizer));

        Auth::guard('organizer')->login($organizer);

        return redirect(RouteServiceProvider::ORGANIZER);
    }

    public function profile()
    {
        $organizer = Auth::guard('organizer')->user();

        return view('organizers.profile')->with([
            'organizer' => $organizer
        ]);
    }

    public function update(OrganizerProfileUpdateRequest $request)
    {
        $fields = $request->validated();
        Auth::guard('organizer')->user()->update($fields);
        return redirect()->back()->with(['success' => 'Profile information successfully updated.']);
    }

    public function updatePassword(OrganizerPasswordUpdateRequest $request)
    {
        $fields = $request->validated();
        $organizer = Auth::guard('organizer')->user();

        $organizer->update([
            'password' => Hash::make($fields['password']),
        ]);

        return redirect()->back()->with('success', 'Password changed successfully.');

    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('organizer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/organizers/login');
    }
}
