<?php

require_once __DIR__ . '/../vendor/autoload.php';

$invoice = new App\Invoice();

$invoice->amount = 15;
var_dump($invoice);

unset($invoice->amount);
var_dump($invoice);