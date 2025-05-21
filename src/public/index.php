<?php

// PSR-4: Autoloader
// https://www.php-fig.org/psr/psr-4/

spl_autoload_register(function($class)
{
    $path = __DIR__ . '/../' . lcfirst(str_replace('\\', '/', $class)) . '.php';

    // 2.4 - Autoloader implementations MUST NOT throw exceptions, 
    // MUST NOT raise errors of any level, and SHOULD NOT return a value.
    if (file_exists($path)) {
        require $path;
    }
    
});

use App\PaymentGateway\Paddle\Transaction;

$paddleTransaction = new Transaction();

var_dump($paddleTransaction);
