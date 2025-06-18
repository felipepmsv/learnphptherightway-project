<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use App\Models\Invoice;

use App\App;
use App\View;
use App\Models\SignUp;
use PDO;

class HomeController
{
    public function index(): View
    {
        // Obtém a instância do banco de dados
        $db = App::db();

        $email = 'joca@doe.com';
        $name = 'Joca Doe';
        $amount = 25;

        $userModel = new User();
        $invoiceModel = new Invoice();

        $invoiceId = (new SignUp($userModel, $invoiceModel))->register(
            [
                'email' => $email,
                'name' => $name,                
            ],
            [
                'amount' => $amount,
            ]
        );        

        return View::make('index', ['invoice' => $invoiceModel->find($invoiceId)]);        
    }

}
