<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\View;
use PDO;

class HomeController
{
    public function index(): View
    {
        // Obtém a instância do banco de dados
        $db = App::db();

        $email = 'jaba@doe.com';
        $name = 'Jaba Doe';
        $amount = 25;

        try 
        {            
            $db->beginTransaction();

            $newUserStmt = $db->prepare(
                'INSERT INTO users (email, full_name, is_active, created_at) 
                VALUES (?, ?, 1, NOW())'
            );

            $newInvoiceStmt = $db->prepare(
                'INSERT INTO invoices (amount, user_id) 
                VALUES (?, ?)'
            );
            
            $newUserStmt->execute([$email, $name]);

            $userId = (int) $db->lastInsertId();

            $newInvoiceStmt->execute([$amount, $userId]);

            $db->commit();
        }
        catch (\Throwable $e) 
        {
            if($db->inTransaction())
            {
                $db->rollBack();
            }            

            throw $e;
        }


        $fetchStmt = $db->prepare(
            'SELECT invoices.id AS invoice_id, amount, user_id, full_name
             FROM invoices
             INNER JOIN users ON user_id = users.id
             WHERE email = ?'
        );

        $fetchStmt->execute([$email]);

        echo '<pre>';
        var_dump($fetchStmt->fetch(PDO::FETCH_ASSOC));
        echo '</pre>';

        return View::make('index');        
    }

}
