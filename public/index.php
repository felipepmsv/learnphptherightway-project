<?php

declare(strict_types = 1);

use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

$invoice1 = new Invoice();
$map = new WeakMap();

$map[$invoice1] = ['a' => 1, 'b' => 2];
//$invoice2 = $invoice1;

var_dump(count($map));
unset($invoice1);
var_dump(count($map));

var_dump($map);

// echo 'Unsetting Invoice 1' . PHP_EOL;
// echo 'Unset Invoice 1' . PHP_EOL;

//var_dump($invoice2);
