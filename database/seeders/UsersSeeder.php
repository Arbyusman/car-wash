<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // Seed the admin user
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('pass1234'),
            'role_id' => 1,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'kasir',
            'email' => 'kasir@gmail.com',
            'password' => Hash::make('pass1234'),
            'role_id' => 2,
            'email_verified_at' => now(),
        ]);

    }
}
