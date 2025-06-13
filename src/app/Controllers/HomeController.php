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
            
            $email = 'joan@doe.com';
            $name = 'Joan Doe';
            $isActive = 1;
            $createdAt = date('Y-m-d H:i:s', strtotime('2023-10-01 12:00:00'));

            $query = 'INSERT INTO users (email, full_name, is_active, created_at) 
            VALUES (:email, :name, :active, :date)';

            $stmt = $db->prepare($query);

            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':active', $isActive, PDO::PARAM_BOOL);
            $stmt->bindValue(':date', $createdAt);

            $stmt->execute();

            $id = (int) $db->lastInsertId();

            $user = $db->query('SELECT * FROM users WHERE id = ' . $id)->fetch();
            
            echo '<pre>';
            var_dump($user);
            echo '</pre>';
                                    
        } 
        catch (\PDOException $e) 
        {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }

        var_dump($db);

        return View::make('index');
        
    }

}
