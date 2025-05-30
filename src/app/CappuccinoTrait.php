<?php

namespace App;

trait CappuccinoTrait
{
    use LatteTrait;
    
    private function makeCappuccino()
    {
        echo static::class . ' is making cappuccino.' . PHP_EOL;
    }
}