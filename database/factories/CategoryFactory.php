<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true), // Random category name
            'description' => $this->faker->sentence(), // Random description
            'image' => 'uploads/categories/' . fake()->image('public/storage/uploads/categories', 640, 480, null, false), // Dynamically generated image name
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
