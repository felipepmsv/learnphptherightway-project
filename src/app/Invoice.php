<?php

declare(strict_types=1);

namespace App;

class Invoice
{
    public int $id; // mudei de string para int por conta do uso de strict_types=1 !!!

    public function __construct(public float $amount)
    {
        $this->id = random_int(10000, 9999999);
    }
    
}