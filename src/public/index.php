<?php

use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

$invoice = new Invoice(25, 'Invoice 1', '123456789123456');

$str = serialize($invoice);

$invoice2 = unserialize($str);

//echo $str . PHP_EOL;
var_dump($invoice2);
