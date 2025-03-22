<?php

namespace Database\Seeders;

use App\Models\Testimoni;
use Illuminate\Database\Seeder;

class TestimoniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonis =
            [
                [
                    'name' => 'putu',
                    'email' => 'putu@gmail.com',
                    'description' => 'A passionate traveler who loves exploring new cultures and cuisines.',
                ],
                [
                    'name' => 'pandu',
                    'email' => 'pandu@gmail.com',
                    'description' => 'Tech enthusiast and avid gamer, always looking for the next big innovation.',
                ],
                [
                    'name' => 'agus',
                    'email' => 'agus@gmail.com',
                    'description' => 'Fitness coach dedicated to helping people achieve their health and wellness goals.',
                ],
                [
                    'name' => 'tina',
                    'email' => 'tina@gmail.com',
                    'description' => 'A creative artist who finds inspiration in nature and everyday life.',
                ],
                [
                    'name' => 'tenri',
                    'email' => 'tenri@gmail.com',
                    'description' => 'Entrepreneur with a passion for startups and building innovative businesses.',
                ],

            ];

        foreach ($testimonis as $testimoni) {
            Testimoni::create($testimoni);
        }
    }
}
