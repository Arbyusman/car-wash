<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Aden Car Wash',
                'short_name' => 'Aden Car Wash',
                'small_icon' => 'default_logo.png',
                'large_icon' => 'default_logo.png',
                'background_login' => 'default_background.jpg',
                'address' => 'Jl. Mekar Jaya 1, Punggolaka, Kec. Puuwatu, Kota Kendari, Sulawesi Tenggara 93115',
                'phone' => '+062 345 6789',
                'email' => 'aden-carwash@gmai.com',
                'opening_hour' => 'Mon - Fri, 08:00 - 22:00',
            ],
        ];

        Setting::insert($data);
    }
}
