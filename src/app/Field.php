<?php

namespace App;

class Field 
{
    public function __construct(protected string $name)
    {
        
    }

    public function render(): string
    {
        return '';
    }
}