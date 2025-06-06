<?php

declare(strict_types=1);

namespace App\Classes;

class Home
{
    public function index(): string
    {
        setcookie(
            'userName',
            'Gio',
            time() + 10 // Cookie expires in 10 seconds
        );

        return 'Home ';
    }

}
