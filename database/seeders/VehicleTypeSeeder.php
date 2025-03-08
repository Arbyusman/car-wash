<?php

namespace Database\Seeders;

use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleTypes = [
            [
                'name' => 'Roda 2',
                'size' => 'SMALL',
            ],
            [
                'name' => 'Roda 4',
                'size' => 'MEDIUM',
            ],
            [
                'name' => 'Roda 6',
                'size' => 'LARGE',
            ],
            [
                'name' => 'Roda 8',
                'size' => 'LARGE',
            ],
            [
                'name' => 'Roda 16',
                'size' => 'EXTRA_LARGE',
            ],
        ];

        foreach ($vehicleTypes as $vehicleType) {
            VehicleType::create($vehicleType);
        }
    }
}
