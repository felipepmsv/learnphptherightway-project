<?php

namespace App;

// Todo metodo da Interface deve ser concretizado na classe que implementa a interface
// ou interfaces, isto é, a classe CollectionAgency deve implementar os métodos 
// de ambas as interfaces!
// Contudo, como DebtCollector estende AnotherInterface, entao a mesma
// nao precisa ser declarada na classe
class CollectionAgency implements DebtCollector
//class CollectionAgency implements DebtCollector, AnotherInterface
{
    public function __construct()
    {

    }     
    
    public function collect(float $owedAmount): float
    {
     
    }

    public function foo()
    {
        // Implementação do método foo
    }
}