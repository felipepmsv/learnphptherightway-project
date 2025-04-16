<?php

declare(strict_types=1);

require_once '../Transaction.php';

// Classes & Objects

$amount = (new Transaction(100, 'Transaction 1'))
    ->addTax(8)
    ->applyDiscount(10)
    ->getAmount();

var_dump($amount);

/*
$transaction = (new Transaction(100, 'Transaction 1'))
    ->addTax(8)
    ->applyDiscount(10);

var_dump($transaction->getAmount());
*/

/*
$transaction1 = (new Transaction(100, 'Transaction 1'))
    ->addTax(8)
    ->applyDiscount(10);

$transaction2 = (new Transaction(200, 'Transaction 2'))
    ->addTax(8)
    ->applyDiscount(15);

var_dump($transaction1->getAmount(), $transaction2->getAmount());
*/

/*
$amount = (new Transaction(100, 'Transaction 1'))
    ->addTax(8)
    ->applyDiscount(10)
    ->getAmount();

//$transaction = (new Transaction(100, 'Transaction 1'))->addTax(8)->applyDiscount(10);
//$transaction = new Transaction(100, 'Transaction 1');

//$transaction->addTax(8)->applyDiscount(10);
//$transaction->addTax(8);
//$transaction->applyDiscount(10);
//$transaction->amount = 15;

var_dump($amount);
//var_dump($transaction->getAmount());
//var_dump($transaction);
//var_dump($transaction->amount);
*/