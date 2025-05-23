<?php

use App\PaymentGateway\Paddle\Transaction;

require_once __DIR__ . '/../vendor/autoload.php';

$transaction = new Transaction(25);

//$transaction->amount;  // propriedade privada, não pode ser acessada diretamente

// Para acessar a propriedade privada, podemos usar ReflectionProperty
$reflectionProperty = new ReflectionProperty(Transaction::class, 'amount');
$reflectionProperty->setAccessible(true);
var_dump($reflectionProperty->getValue($transaction));
echo '<br>';

// Agora o valor foi alterado
$reflectionProperty->setValue($transaction, 50);
var_dump($reflectionProperty->getValue($transaction));
echo '<br>';

$transaction->process();
