<?php

namespace App;

class Invoice
{
    // Magic method to handle dynamic property access
    public function __get($name)
    {
        var_dump($name); 
    }

    public function __set($name, $value): void
    {
        var_dump($name, $value);
    }
}