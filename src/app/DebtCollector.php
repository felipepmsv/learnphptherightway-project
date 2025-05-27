<?php

namespace App;

interface DebtCollector extends AnotherInterface, SomeOtherInterface
{
    public function __construct();

    public function collect(float $owedAmount): float;
}