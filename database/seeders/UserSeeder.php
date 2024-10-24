<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed 50 users using the UserFactory
        User::factory()->count(10)->create();
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('@Mag0245'),
        ]);
    }
}
