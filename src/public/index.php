<?php

use App\Customer;
use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

$invoice = new Invoice(new Customer());

try 
{
    $invoice->process(25);
} 
catch (App\Exception\MissingBillingInfoException $e) 
{
    echo $e->getMessage() . ' ' . $e->getFile() . ':' . $e->getLine() . PHP_EOL;
}
