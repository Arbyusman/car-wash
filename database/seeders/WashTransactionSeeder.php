<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Washer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WashTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $washers = Washer::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();

        $faker = \Faker\Factory::create();

        $data = [];
        for ($i = 0; $i < 2000; $i++) {
            $totalCost = round($faker->numberBetween(20000, 100000), -4);
            $payment = round($totalCost + $faker->numberBetween(0, 50000), -4);
            $change = $payment - $totalCost;

            $createdAt = $faker->dateTimeBetween('-1 year', 'now');

            $data[] = [
                'transaction_number' => 'TRX-' . strtoupper(Str::random(10)),
                'payment_amount'     => $payment,
                'change_amount'      => $change,
                'total_cost'         => $totalCost,
                'is_printed'         => $faker->boolean(),
                'washer_id'          => $faker->randomElement($washers),
                'created_by'         => $faker->randomElement($users),
                'updated_by'         => $faker->randomElement($users),
                'deleted_by'         => null,
                'created_at'         => $createdAt,
                'updated_at'         => $createdAt,
            ];
        }

        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('wash_transactions')->insert($chunk);
        }
    }
}
