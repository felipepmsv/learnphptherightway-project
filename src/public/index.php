<?php

use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

$invoice1 = new Invoice(25, 'My Invoice 1');
$invoice2 = new Invoice(100, 'My Invoice 2');

echo 'invoice1 == invoice2' . PHP_EOL;
var_dump($invoice1 == $invoice2);

echo 'invoice1 === invoice2' . PHP_EOL;
var_dump($invoice1 === $invoice2);

