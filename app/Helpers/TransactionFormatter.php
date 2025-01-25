<?php

namespace App\Helpers;

class TransactionFormatter
{
    public static function dollars($amount): string
    {
        $isNegative = $amount < 0;
        return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
    }

    public static function date($date)
    {
        return \DateTime::createFromFormat('Y-m-d', $date)->format('F j, o');
    }
}