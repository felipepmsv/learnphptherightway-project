<?php

declare(strict_types=1);

namespace App;

use App\Exception\InvoiceException;

class Invoice
{
    public function __construct(public Customer $customer)
    {
    }

    public function process(float $amount): void
    {
        if($amount <= 0) {
            throw InvoiceException::invalidAmount();            
        }

        if(empty($this->customer->getBillingInfo())) {
            throw InvoiceException::missingBillingInfo();            
        }
        
        echo 'Processing $' . $amount . ' invoice - ';

        sleep(1);

        echo 'OK' . PHP_EOL;
    }    
}