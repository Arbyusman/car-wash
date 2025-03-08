<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicles = [
            [
                'vehicle_type_id' => 2,
                'name' => 'Avanza',
                'cost' => 75000,
                'washer_cost' => 25000,
            ],
            [
                'vehicle_type_id' => 2,
                'name' => 'Sigra',
                'cost' => 75000,
                'washer_cost' => 25000,
            ],
            [
                'vehicle_type_id' => 2,
                'name' => 'Calya',
                'cost' => 75000,
                'washer_cost' => 25000,
            ],
            [
                'vehicle_type_id' => 2,
                'name' => 'Terios',
                'cost' => 75000,
                'washer_cost' => 25000,
            ],
            [
                'vehicle_type_id' => 2,
                'name' => 'Rush',
                'cost' => 75000,
                'washer_cost' => 25000,
            ],
            [
                'vehicle_type_id' => 1,
                'name' => 'Jupiter MX King 150',
                'cost' => 15000,
                'washer_cost' => 5000,
            ],
            [
                'vehicle_type_id' => 1,
                'name' => 'Mio M3 125',
                'cost' => 10000,
                'washer_cost' => 5000,
            ],
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }
    }
}
