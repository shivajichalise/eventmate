<?php

namespace App\Console;

use App\Models\Event;
use App\Notifications\EventStartedNotification;
use App\Notifications\EventEndedNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // Schedule the "Event Started" notification
        $schedule->call(function () {
            Event::where('event_start', '<=', now()->format('Y-m-d H:i:s'))
            ->where('event_end', '>', now()->format('Y-m-d H:i:s'))
            ->get()
            ->each(function ($event) {
                $attendees = $event->attendees()->get();
                Notification::send($attendees, new EventStartedNotification($event));
            });
        })->everyMinute();

        // Schedule the "Event Ended" notification
        $schedule->call(function () {
            Event::where('event_end', '<=', now()->format('Y-m-d H:i:s'))
                ->get()
                ->each(function ($event) {
                    $attendees = $event->attendees()->get();
                    Notification::send($attendees, new EventEndedNotification($event));
                });
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
