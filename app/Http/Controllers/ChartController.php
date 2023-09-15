<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public static function lineChart(?Event $event = null): array
    {
        $userData = [];
        if($event) {
            $attendees = $event->attendees();

            $userData = $attendees->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        } else {
            $userData = User::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        }

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

    public static function barChart(?Event $event = null): array
    {
        $userData = [];
        if($event) {
            $attendees = $event->attendees();

            $userData = $attendees->select('country')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('country')
            ->get();
        } else {
            $userData = User::select('country')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('country')
            ->get();
        }

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
}
