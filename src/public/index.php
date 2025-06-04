<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dateTime = new DateTime('00:00');

echo $dateTime->format('d/m/Y H:i') . ' - ' . $dateTime->getTimeZone()->getName() . PHP_EOL;

$dateTime->setTimezone(new DateTimeZone('Europe/Lisbon'));

echo $dateTime->format('d/m/Y H:i') . ' - ' . $dateTime->getTimeZone()->getName() . PHP_EOL;
