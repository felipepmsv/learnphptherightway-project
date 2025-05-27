<?php

namespace App;

class Invoice
{
    // Magic method to handle dynamic property access
    public function __get($name)
    {
        var_dump($name); 
    }
}