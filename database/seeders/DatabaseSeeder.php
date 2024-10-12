<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\UserSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
 
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            UserSeeder::class
        ]);


 
    }
}
