<?php

require_once __DIR__ . '/../vendor/autoload.php';

$invoice = new \App\Invoice();
$invoice2 = new $invoice;

var_dump($invoice, $invoice2, \App\Invoice::create());
