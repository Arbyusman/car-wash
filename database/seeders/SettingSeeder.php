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
                'phone' => '+62 345 6789',
                'email' => 'aden-carwash@gmai.com',
                'opening_hour' => 'Mon - Fri, 08:00 - 22:00',
                'embed_map' => '<iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.227695478214!2d122.4932499!3d-3.9734848!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d98f2dfe9a18065%3A0x575c442301059b78!2sAden%20Car%20Wash!5e0!3m2!1sen!2sid!4v1742058231983!5m2!1sen!2sid"
                                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>',
            ],
        ];

        Setting::insert($data);
    }
}
