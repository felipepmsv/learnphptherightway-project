<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use PDO;

class HomeController
{
    public function index(): View
    {
        try 
        {            
            $db = new PDO('mysql:host=db;dbname=my_db', 'root', 'root', []);

            // Criando uma situação de SQL Injection
            // A URL de exemplo para testar a injeção SQL seria:
            // http://localhost:8000/?email=foo@bar.com%22+OR+1=1+--+
            $email = $_GET['email'];
            $query = 'SELECT * FROM users WHERE email = "' . $email . '"';

            echo $query . '<br><br>';
            
            foreach($db->query($query) as $user)            
            {
                echo '<pre>';
                var_dump($user);
                echo '</pre>';
            }                        
        } 
        catch (\PDOException $e) 
        {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }

        var_dump($db);

        return View::make('index');
        
    }

}
