<?php

require_once __DIR__ . '/../vendor/autoload.php';

foreach(new App\Invoice(25) as $key => $value) {
    echo $key . ' => ' . $value . PHP_EOL;
}
