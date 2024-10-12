<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 50 random users
        User::factory(10)->create();
        Product::factory()->count(15)->create(); // Create 50 products
        Category::factory()->count(5)->create(); // Create 5 categories


 
    }
}
