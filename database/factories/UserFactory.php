<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'gender' => fake()->randomElement(['Male', 'Female', 'Other']),
            'is_disabled' => false,
            'password' => bcrypt('password'), // You can set a default password or use fake()->password
            'address_line_1' => fake()->streetAddress(),
            'state' => fake()->state(),
            'city' => fake()->city(),
            'country' => fake()->country(),
            'mobile_number' => '9' . fake()->numberBetween(100000000, 999999999),
            'emergency_number' => '9' . fake()->numberBetween(100000000, 999999999),
            'profile_status' => json_encode([]),
            'is_active' => true,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
