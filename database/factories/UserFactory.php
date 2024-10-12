<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // default password
            'role' => $this->faker->randomElement(['admin', 'user']),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'email_verified_at' => now(),
            // 'image' => 'uploads/usersprofiles/' . fake()->image('public/storage/uploads/usersprofiles'), // Dynamically generated image name
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
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
