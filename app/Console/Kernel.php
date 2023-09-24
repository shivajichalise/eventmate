<?php

namespace App\Console;

use App\Models\Event;
use App\Notifications\EventStartedNotification;
use App\Notifications\EventEndedNotification;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
            Event::where('event_start', '<=', now())
                ->where('event_end', '>', now())
                ->get()
                ->each(function ($event) {
                    $event->notify(new EventStartedNotification($event));
                });
        })->everyMinute(); // Adjust the frequency as needed

        // Schedule the "Event Ended" notification
        $schedule->call(function () {
            Event::where('event_end', '<=', now())
                ->get()
                ->each(function ($event) {
                    $event->notify(new EventEndedNotification($event));
                });
        })->everyMinute(); // Adjust the frequency as needed
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
