<?php

use App\Customer;
use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

$invoice = new Invoice(new Customer(['foo' => 'bar']));

try 
{
    $invoice->process(25);
} 
catch (\Exception $e) 
{
    echo $e->getMessage() . PHP_EOL;
}
finally 
{
    echo 'Finally block' . PHP_EOL;
}
