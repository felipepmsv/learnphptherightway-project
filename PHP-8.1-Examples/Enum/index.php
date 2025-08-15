<?php

declare(strict_types = 1);

use PHP_8_1_Examples\Enum\Payment;
use PHP_8_1_Examples\Enum\PaymentStatus;

require_once __DIR__ . '/../../vendor/autoload.php';

$payment = new Payment();
$payment->updateStatus(PaymentStatus::PAID);

echo $payment->status() . PHP_EOL;
