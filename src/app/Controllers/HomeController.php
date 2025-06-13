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
            $db = new PDO('mysql:host=db;dbname=my_db', 'root', 'root', [                
                // desta forma, o fetchAll retorna um array de objetos
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ                
            ]);

            $query = 'SELECT * FROM users';
            
            foreach($db->query($query) as $user)             
            //foreach($db->query($query)->fetchAll(PDO::FETCH_OBJ) as $user) // retorna um array de objetos            
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
