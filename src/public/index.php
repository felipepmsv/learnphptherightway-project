<?php

use App\Toaster;

require_once __DIR__ . '/../vendor/autoload.php';

$toaster = new Toaster();

$toaster->addSlice('bread');
$toaster->addSlice('bread');
$toaster->addSlice('bread');

$toaster->toast();
