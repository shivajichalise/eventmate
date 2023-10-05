<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $start_date = Carbon::parse('2022-10-01'); // Set the starting date
        $end_date = Carbon::parse('2023-10-05'); // Set the ending date
        $current_date = $start_date;

        while ($current_date <= $end_date) {
            $userCount = rand(1, 69); // Generate a random number of users for each day

            // Set the time part to a random value between 00:00:00 and 23:59:59
            $time = Carbon::createFromTime(rand(0, 23), rand(0, 59), rand(0, 59));
            $current_date->setTime($time->hour, $time->minute, $time->second);

            User::factory($userCount)->create([
                'created_at' => $current_date,
                'updated_at' => $current_date,
            ]);


            $current_date->addMonth(); // Move to the next day

            // \App\Models\User::factory(10)->create();

            // \App\Models\User::factory()->create([
            //     'name' => 'Attendee',
            //     'email' => 'attendee@eventmate.com',
            // ]);
        }
    }
}
