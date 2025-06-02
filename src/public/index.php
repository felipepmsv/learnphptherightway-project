<?php

use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

$invoice1 = new Invoice(25, 'My Invoice');
$invoice2 = new Invoice(25, 'My Invoice');

$invoice3 = $invoice1;

echo 'invoice1 == invoice3' . PHP_EOL;
var_dump($invoice1 == $invoice3);

echo 'invoice1 === invoice3' . PHP_EOL;
var_dump($invoice1 === $invoice3);

