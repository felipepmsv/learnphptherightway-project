<?php

namespace App\Helpers;

class TransactionFormatter
{
    public static function dollars(string $amount): string
    {
        $isNegative = $amount < 0;
        return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
    }

    public static function date(string $date): string
    {
        return \DateTime::createFromFormat('Y-m-d', $date)->format('F j, o');
    }
}