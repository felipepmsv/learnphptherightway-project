<?php

namespace App;

// Essa classe não deve ser instanciada diretamente, mas sim estendida por outras classes.
abstract class Field 
{
    public function __construct(protected string $name)
    {
        
    }

    // Esse metodo deve ser implementado por todas as classes que estendem Field.
    abstract public function render(): string;
}