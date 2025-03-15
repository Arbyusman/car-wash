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
                'address' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus nihil fuga, voluptates in vel autem. Maiores tempora numquam ipsa nostrum!
',
            ],
        ];

        Setting::insert($data);
    }
}
