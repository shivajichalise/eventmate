<?php

namespace Database\Seeders;

use App\Models\Organizer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organizer::factory()->create([
            'name' => 'Super Organizer',
            'email' => 'organizer@eventmate.com',
            'is_super' => true,
        ]);

        Organizer::factory(1)->create();
    }
}
