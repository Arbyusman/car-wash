<?php

namespace App\Traits;

trait CurrencyTrait
{
    public function convertToInteger(?string $value): ?int
    {
        if (! $value) {
            return null;
        }

        return (int) preg_replace('/[^0-9]/', '', $value);
    }
}
