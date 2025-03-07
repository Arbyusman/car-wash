<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait CurrencyTrait
{
    public function convertToInteger(?string $value): ?int
    {
        if (! $value) {
            return null;
        }

        return (int) preg_replace('/[^0-9]/', '', $value);
    }

    private function generateTransactionNumber()
    {
        $datePrefix = now()->format('Ymd');

        $lastTransaction = DB::table('wash_transactions')
            ->latest('id')
            ->first();

        if ($lastTransaction) {
            $lastIncrement = (int) substr($lastTransaction->transaction_number, -4);
            $newIncrement = str_pad($lastIncrement + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newIncrement = '0001';
        }

        return $datePrefix.'-'.$newIncrement;
    }
}
