<?php

declare(strict_types=1);

namespace App;

class Invoice
{
    public function __invoke()
    {
        // The __invoke() method is called when a script tries to call an object as a function.
        // It's useful for creating callable objects.
        // This method can be used to encapsulate functionality that you want to execute
        // when the object is called like a function.
        // For example, you might want to generate an invoice or perform some action related to invoicing.
        
        var_dump('invoked');
    }
}