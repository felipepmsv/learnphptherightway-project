<?php

require_once __DIR__ . '/../vendor/autoload.php';

$invoice = new \App\Invoice();

$invoice2 = $invoice; // ambos $invoice apontam para o mesmo objeto na memória


var_dump($invoice, $invoice2, $invoice === $invoice2); // retorna true
