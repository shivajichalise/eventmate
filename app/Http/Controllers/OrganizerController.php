<?php

namespace App\Http\Controllers;

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

        $barChart = $this->barChart();
        $lineChart = $this->lineChart();

        // return $lineChart;

        return view('dashboard')->with([
            'totalEvents' => $totalEvents,
            'totalUsers' => $totalUsers,
            'totalTicketsSold' => $totalTicketsSold,
            'totalRevenue' => $totalRevenue,
            'barChart' => $barChart,
            'lineChart' => $lineChart,
        ]);
    }

    protected function lineChart(): array
    {
        $userData = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('month')
        ->orderBy('month', 'asc')
        ->get();

        // Initialize arrays for labels (months) and data (user counts)
        $labels = [];
        $data = [];

        // Fill the arrays with month names and user counts
        foreach ($userData as $entry) {
            $month = DateTime::createFromFormat('!m', $entry->month)->format('F'); // Format the month
            $labels[] = $month;
            $data[] = $entry->count;
        }

        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'User Growth',
                    'data' => $data,
                    'fill' => false,
                    'borderColor' => 'rgb(75, 192, 192)',
                    'tension' => 0.1
                ],
            ],
        ];

        return $chartData;
    }

    protected function barChart(): array
    {
        $userData = User::select('country')
        ->selectRaw('COUNT(*) as count')
        ->groupBy('country')
        ->get();
        // Initialize arrays for labels, data, and backgroundColor
        $labels = [];
        $data = [];
        $backgroundColor = [];

        // Generate random colors for each bar
        $colors = [
            'rgba(255, 87, 51, 0.7)',   // Red with opacity
            'rgba(255, 195, 0, 0.7)',   // Yellow with opacity
            'rgba(51, 255, 87, 0.7)',   // Green with opacity
            'rgba(51, 153, 255, 0.7)',  // Blue with opacity
            'rgba(255, 51, 255, 0.7)',  // Purple with opacity
            'rgba(255, 87, 51, 0.7)',   // Red with opacity
            'rgba(255, 195, 0, 0.7)',   // Yellow with opacity
            'rgba(51, 255, 87, 0.7)',   // Green with opacity
            'rgba(51, 153, 255, 0.7)',  // Blue with opacity
            'rgba(255, 51, 255, 0.7)',  // Purple with opacity
            'rgba(102, 102, 102, 0.7)', // Gray with opacity
            'rgba(255, 153, 0, 0.7)',   // Orange with opacity
            'rgba(255, 153, 204, 0.7)', // Pink with opacity
            'rgba(102, 204, 102, 0.7)', // Light Green with opacity
            'rgba(51, 102, 153, 0.7)',  // Dark Blue with opacity
        ];

        foreach ($userData as $user) {
            $labels[] = $user->country;
            $data[] = $user->count;
            $backgroundColor[] = array_shift($colors);
        }

        // Prepare the chart data array
        $chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'User Count by Country',
                    'data' => $data,
                    'backgroundColor' => $backgroundColor,
                ],
            ],
        ];

        return $chartData;
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

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('organizer')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/organizers/login');
    }
}
