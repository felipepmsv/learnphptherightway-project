<?php

require_once __DIR__ . '/../vendor/autoload.php';

$invoice = new \App\Invoice();

$invoice2 = clone $invoice; // clona o objeto, criando uma nova instância


var_dump($invoice, $invoice2, $invoice === $invoice2); // retorna false
