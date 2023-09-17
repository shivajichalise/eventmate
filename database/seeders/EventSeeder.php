<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\SubEvent;
use App\Models\Support;
use App\Models\Ticket;
use App\Models\Venue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Vinkla\Hashids\Facades\Hashids;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generalFields = [
            'name' => 'Auto Generated Event',
            'description' => 'This is an auto generated event when the app was initialized.',
            'event_start' => now()->format('Y-m-d H:i:s'),
            'event_end' => now()->addDays(30)->format('Y-m-d H:i:s'),
            'registration_start' => now()->format('Y-m-d H:i:s'),
            'registration_end' => now()->addDays(30)->format('Y-m-d H:i:s'),
            'status' => true,
        ];

        $event = Event::create($generalFields);

        $venueFields = [
            'event_id' => $event->id,
            'address' => fake()->address(),
            'country' => fake()->country(),
            'state' => fake()->state(),
            'city' => fake()->city(),
            'lat' => fake()->latitude(),
            'lng' => fake()->longitude(),
        ];

        Venue::create($venueFields);

        $subEventFields = [
            [
                'event_id' => $event->id,
                'name' => 'Sub Event 1',
                'event_start' => now()->format('Y-m-d H:i:s'),
                'event_end' => now()->addDays(10)->format('Y-m-d H:i:s'),
            ],
            [
                'event_id' => $event->id,
                'name' => 'Sub Event 2',
                'event_start' => now()->addDays(11)->format('Y-m-d H:i:s'),
                'event_end' => now()->addDays(20)->format('Y-m-d H:i:s'),
            ],
        ];

        foreach($subEventFields as $subEventField) {
            $subEvent = SubEvent::create($subEventField);

            $ticketFields = [
                [
                    'sub_event_id' => $subEvent->id,
                    'code' => Hashids::encode($subEvent->id, time(), 1),
                    'currency' => 'NPR',
                    'price' => 1000,
                    'tax' => 13,
                    'limit' => 100,
                ],
                [
                    'sub_event_id' => $subEvent->id,
                    'code' => Hashids::encode($subEvent->id, time()+60, 2),
                    'currency' => 'NPR',
                    'price' => 2000,
                    'tax' => 13,
                    'limit' => 100,
                ],
            ];

            foreach($ticketFields as $ticketField) {
                Ticket::create($ticketField);
            }
        }

        $supportFields = [
            'event_id' => $event->id,
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'mobile' => fake()->phoneNumber(),
            'address' => fake()->address(),
        ];

        Support::create($supportFields);
    }
}
