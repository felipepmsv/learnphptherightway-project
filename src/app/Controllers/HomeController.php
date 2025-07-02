<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Models\Transaction;
use App\View;
use PDO;

class HomeController
{
    public function index(): View
    {
        try 
        {
            $db = new PDO('mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'],
                $_ENV['DB_USER'],
                $_ENV['DB_PASS']
            );
        } 
        catch (\PDOException $e) 
        {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $transData = '2023-10-04';
        $transNumb = '1000';
        $transDesc = 'Travel expenses';
        $transAmnt = '500.00';

        // MODEL inicio

        $transactionModel = new Transaction();

        $transactionId = $transactionModel->create(
            $transData,
            $transNumb,
            $transDesc,
            $transAmnt
        );

        // MODEL final

        $row = $transactionModel->find($transactionId);
        
        echo '<pre>';
        var_dump($row);
        echo '</pre>';

        var_dump($db);

        return View::make('index');
    }

    public function getTransactions(string $fileName): array
    {
        if (!file_exists($fileName)) {
            trigger_error("File not found: $fileName", E_USER_WARNING);
        }

        $file = fopen($fileName, 'r');

        fgetcsv($file); // Pula o cabeçalho do CSV

        $transactions = [];

        while (($transaction = fgetcsv($file)) !== false)
        {            
            $transactions[] = $transaction;
        }

        return $transactions;
    }

    public function upload(): View
    {
        /*
        echo '<pre>';
        var_dump($_FILES);
        echo '</pre>';
        */

        $filePath = STORAGE_PATH . '/' . $_FILES['receipt']['name'];

        // Para o uso desse comando foi necessario: 
        // 1. criar a pasta storage
        //    mkdir storage
        // 2. descobrir o dono do servidor web
        //    ps aux | grep php-fpm
        // 3. dar permissão de escrita para o servidor web
        //    sudo chown -R www-data:www-data storageAdd commentMore actions
        // 4. dar permissão de escrita a pasta storage
        //    sudo chmod -R 755 storage

        move_uploaded_file(
            $_FILES['receipt']['tmp_name'],
            $filePath            
        );

        /*
        echo '<pre>';
        var_dump(pathinfo($filePath));
        echo '</pre>';
        */

        $transactions = [];

        $transactions = array_merge($transactions, $this->getTransactions($filePath));

        //print_r($transactions);

        return View::make('transactions', ['transactions' => $transactions]);        
    }
}
