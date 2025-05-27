<?php

namespace App;

class Invoice
{
    public function __get($name)
    {
        var_dump($name); 
    }
}