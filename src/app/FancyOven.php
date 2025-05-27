<?php

namespace App;

class FancyOven
{   
    public function __construct(private ToasterPro $toaster)
    {
        
    }

    public function fry()
    {
        // fry stuff
    }

    public function toast()
    {
        // propriedade inicializada no construtor
        // chama o método toast da classe ToasterPro
        // via Composition (has-a relationship)
        // diferente de Inheritance (herança) (is-a relationship)
        // A classe FancyOven "tem um" ToasterPro,
        // ou seja, a classe FancyOven tem uma instância de ToasterPro
        // e pode chamar seus métodos
        $this->toaster->toast();
    }

    public function toastBagel()
    {
        $this->toaster->toastBagel();
    }

}