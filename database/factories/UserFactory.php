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
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'role' => fake()->randomElement(['user', 'admin']), // Randomly choose between 'user' and 'admin'
            'image' => 'uploads/usersprofiles/' . fake()->image('public/uploads/usersprofiles', 640, 480, null, false), // Dynamically generated image name
            'address' => fake()->address(),
            'phone' => $this->generateValidPhoneNumber(),
            'password' => bcrypt('password'), // Use bcrypt for hashing
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Generate a valid phone number.
     *
     * @return string
     */
    private function generateValidPhoneNumber(): string
    {
        return '+1 ' . fake()->numberBetween(100, 999) . ' ' . 
               fake()->numberBetween(100, 999) . '-' . 
               fake()->numberBetween(1000, 9999);
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
