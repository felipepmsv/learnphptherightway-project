<?php

use App\CustomInvoice;
use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

$invoice1 = new Invoice(new \App\Customer('Customer 1'), 25, 'My Invoice');
$invoice2 = new Invoice(new \App\Customer('Customer 2'), 25, 'My Invoice'); 

// gerará erro de recursão infinita, 
// por conta de referencia circular!
$invoice1->linkedInvoice = $invoice2;
$invoice2->linkedInvoice = $invoice1;

echo 'invoice1 == invoice2' . PHP_EOL;
var_dump($invoice1 == $invoice2);

echo 'invoice1 === invoice2' . PHP_EOL;
var_dump($invoice1 === $invoice2);

var_dump($invoice1, $invoice2); 
