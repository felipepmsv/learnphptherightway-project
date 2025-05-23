<?php

declare(strict_types=1);

namespace App\PaymentGateway\Paddle;

class Transaction
{      
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;        
    }

    // Se não precisamos obter o valor do atributo, não precisamos de um getter
    // já que o mesmo já foi passado no construtor
    // public function getAmount(): float
    // {
    //     return $this->amount;
    // }

    // Nesse caso, se precisamos alterar o valor do atributo, 
    // criamos uma nova instancia da classe e, portanto, não precisamos de um setter
    // public function setAmount(float $amount): void
    // {
    //     $this->amount = $amount;
    // }

    public function process()
    {
        echo 'Processing $' . $this->amount . ' transaction';
    }
 
}