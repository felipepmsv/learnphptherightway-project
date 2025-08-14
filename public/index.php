<?php

declare(strict_types = 1);

use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

$invoice1 = new Invoice();
//$invoice2 = $invoice1;

echo 'Unsetting Invoice 1' . PHP_EOL;
unset($invoice1);
echo 'Unset Invoice 1' . PHP_EOL;

//var_dump($invoice2);
