<?php

use App\Customer;
use App\Invoice;

require_once __DIR__ . '/../vendor/autoload.php';

set_exception_handler(function(\Throwable $e) {
    var_dump($e->getMessage());
});

echo array_rand([], 1);

$invoice = new Invoice(new Customer());

$invoice->process(25);