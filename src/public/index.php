<?php

use App\DB;
use App\PaymentGateway\Paddle\Transaction;

require_once __DIR__ . '/../vendor/autoload.php';

$transaction = new Transaction(25, 'Transaction 1');

var_dump($transaction::getCount());

// Somente uma instancia de DB será criada
// $db = DB::getInstance([]);
// $db = DB::getInstance([]);
// $db = DB::getInstance([]);
// $db = DB::getInstance([]);
// $db = DB::getInstance([]);

//var_dump($transaction::process());
//var_dump($transaction::$amount);
//var_dump(Transaction::getCount());
//var_dump(Transaction::$count);
//var_dump($transaction::$count);