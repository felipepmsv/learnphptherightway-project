<?php

namespace App;

class Invoice
{
    protected array $data;

    // Continuam quebrando o encapsulamento !!!
    
    public function __get(string $name)
    {
        if(array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return null;
    }

    public function __set($name, $value): void
    {
        $this->data[$name] = $value;
    }
}