<?php

require_once __DIR__ . '/../vendor/autoload.php';

// echo '<pre>';
// print_r($_SERVER);
// echo '</pre>';

$router = new \App\Router();

$router->register(
    '/',
    function () {
        echo 'Home';
    }
);

$router->register(
    '/invoices',
    function () {
        echo 'Invoices';
    }
);

echo $router->resolve($_SERVER['REQUEST_URI']);