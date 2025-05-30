<?php

namespace App;

class AllInOneCoffeeMaker extends CoffeeMaker
{
    use LatteTrait;
    use CappuccinoTrait {
        CappuccinoTrait::makeLatte insteadof LatteTrait;
    }
}
