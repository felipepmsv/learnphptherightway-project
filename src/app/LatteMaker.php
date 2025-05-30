<?php

namespace App;

class LatteMaker extends CoffeeMaker
{
    use LatteTrait;

    private string $milkType = 'another-milk';
}
