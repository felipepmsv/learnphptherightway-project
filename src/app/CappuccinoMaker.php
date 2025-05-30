<?php

namespace App;

class CappuccinoMaker extends CoffeeMaker
{
    use CappuccinoTrait {
        CappuccinoTrait::makeCappuccino as public;
    }
}
