<?php

namespace Database\Seeders;

use App\Models\WashingPoint;
use Illuminate\Database\Seeder;

class WashingPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $washingPoints = [
            [
                'address' => 'l. Mekar Jaya 1, Punggolaka, Kec. Puuwatu, Kota Kendari, Sulawesi Tenggara 93115',
                'phone' => '+62 345 6789',
            ],

        ];

        foreach ($washingPoints as $washingPoint) {
            WashingPoint::create($washingPoint);
        }
    }
}
