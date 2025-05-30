<?php

namespace App;

trait LatteTrait
{
    public function makeLatte()
    {
        // Tentar acessar a propriedade milkType sem definir a mesma,
        // acreditando que ela foi definida na classe que usa o trait LatteTrait,
        // pode causar um erro se a propriedade não existir.
        
        echo static::class . ' is making latte with ' . $this->milkType . PHP_EOL;
    }
}