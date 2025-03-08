<?php

namespace Database\Seeders;

use App\Models\Washer;
use Illuminate\Database\Seeder;

class WasherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $washers = [
            [
                'name' => 'Munasar',
            ],
            [
                'name' => 'Asep',
            ],
            [
                'name' => 'Ujang',
            ],
            [
                'name' => 'Putu',
            ],
            [
                'name' => 'Made',
            ],
        ];

        foreach ($washers as $washer) {
            Washer::create($washer);
        }
    }
}
