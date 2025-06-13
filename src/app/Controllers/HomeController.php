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
            // o nome do host é o mesmo do serviço criado no docker-compose.yml
            // referente ao banco de dados
            $db = new PDO('mysql:host=db;dbname=my_db', 'root', 'root', []);

            $query = 'SELECT * FROM users';

            $stmt = $db->query($query);

            var_dump($stmt->fetchAll());
        } 
        catch (\PDOException $e) 
        {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }

        var_dump($db);

        return View::make('index');
        
    }

}
