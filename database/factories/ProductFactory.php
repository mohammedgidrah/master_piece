<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'category_id' => \App\Models\Category::factory(), // Creates a related category
            'name' => $this->faker->words(3, true), // Generates a random product name consisting of 3 words
            'description' => $this->faker->text(200), // Random description text
            'price' => $this->faker->randomFloat(2, 1, 1000), // Random price between 1 and 1000
            'stock' => $this->faker->randomElement(['in_stock', 'out_of_stock']), // Random stock status
            // 'image' => 'uploads/products/' . fake()->image('public/storage/uploads/products'), // Dynamically generated image name

            'quantity' => $this->faker->randomNumber(2),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
