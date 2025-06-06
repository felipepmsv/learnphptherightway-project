<?php

declare(strict_types=1);

namespace App\Classes;

class Home
{
    public function index(): string
    {
        echo '<pre>';
        var_dump($_REQUEST);
        echo '</pre>';

        echo '<pre>';
        var_dump($_GET);
        echo '</pre>';

        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
        
        return '<form action="/?foo=bar&amount=250" method="post"><label>Amount</label><input type="text" name="amount" /></form>';
        //return 'Home';
    }

}
