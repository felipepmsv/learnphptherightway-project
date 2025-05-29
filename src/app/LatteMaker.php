<?php

namespace App;

class LatteMaker extends CoffeeMaker
{
    public function makeLatte()
    {
        echo static::class . ' is making latte.' . PHP_EOL;
    }
}
