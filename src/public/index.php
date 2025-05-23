<?php

use App\PaymentGateway\Paddle\Transaction;

require_once __DIR__ . '/../vendor/autoload.php';

$transaction = new Transaction(25);

//$transaction->amount = 50; // This will cause an error because $amount is private

$transaction->process();
