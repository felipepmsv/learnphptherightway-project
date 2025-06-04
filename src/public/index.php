<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dateTime1 = new DateTime('2025-05-23 09:15:35 AM');
$dateTime2 = new DateTime('2021-03-15 03:22:26 AM');

echo $dateTime1->diff($dateTime2)->format('%Y years, %M months, %D days, %H hours, %I minutes, %S seconds') . "\n";
