<?php

namespace App;

class Invoice
{
    protected float $amount;    

    public function __construct(float $amount = 0.0)
    {
        $this->amount = $amount;
    }

    // Esses dois metodos quebram o encapsulamento !!!
    
    // public function __get($name)
    // {
    //     if(property_exists($this, $name)) {
    //         return $this->$name;
    //     }

    //     return null;
    // }

    // public function __set($name, $value): void
    // {
    //     if(property_exists($this, $name)) {
    //         $this->$name = $value;
    //     }
    // }
}