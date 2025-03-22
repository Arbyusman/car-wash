<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // USERS
            RoleSeeder::class,
            UsersSeeder::class,

            // WEB
            SettingSeeder::class,

            // MASTER

            VehicleTypeSeeder::class,
            VehicleSeeder::class,
            WasherSeeder::class,
            WashingPointSeeder::class,
            TestimoniSeeder::class,
            AboutUsSeeder::class,

        ]);

    }
}
