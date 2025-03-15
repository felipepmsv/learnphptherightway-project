<?php

declare(strict_types=1);

namespace App;

use DateTime;

class Helpers
{
    public static function formateDate(string $date): string
    {
        $date = new DateTime($date);
        return $date->format('M j Y');
    }

    public static function formatDollar(float $amount): string
    {
        $isNegative = $amount < 0;
        return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
    }
}