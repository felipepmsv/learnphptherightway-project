<?php

require_once __DIR__ . '/../vendor/autoload.php';

$invoice = new App\Invoice();

$invoice->process(15, 'Some Description');      // call
App\Invoice::process(15, 'Some Description');   // callStatic
