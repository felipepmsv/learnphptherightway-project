<?php

use App\CustomInvoice;
use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

$invoice1 = new Invoice(new \App\Customer('Customer 1'), 25, 'My Invoice');
$invoice2 = new Invoice(new \App\Customer('Customer 2'), 25, 'My Invoice'); // false
//$invoice2 = new Invoice(new \App\Customer('Customer 1'), 25, 'My Invoice'); //  true

echo 'invoice1 == invoice2' . PHP_EOL;
var_dump($invoice1 == $invoice2);

echo 'invoice1 === invoice2' . PHP_EOL;
var_dump($invoice1 === $invoice2);

// a primeira comparação verifica se os valores dos objetos são iguais, 
// enquanto a segunda verifica se são o mesmo objeto na memória.
var_dump($invoice1, $invoice2); 

