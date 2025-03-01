<?php

namespace App\Enums;

enum SizeTypes: string
{
    case SMALL = 'SMALL';
    case MEDIUM = 'MEDIUM';
    case LARGE = 'LARGE';
    case EXTRA_LARGE = 'EXTRA_LARGE';

    public static function toValueArray()
    {
        return array_column(self::cases(), 'value');
    }
}
