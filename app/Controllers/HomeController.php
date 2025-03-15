<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Exceptions\FileNotFoundException;
use App\Models\TransactionModel;
use App\View;
use Exception;

class HomeController
{
    public function index(): View
    {
        return View::make('index');
    }

    public function store() 
    {
       $fileName = $_FILES['transaction']['tmp_name'];
       $destination = STORAGE_PATH . uniqid() . $_FILES['transaction']['name'];

       if (! file_exists($fileName)) {
        throw new FileNotFoundException();
       }

       try {
        $transactionModel = new TransactionModel();
        $transactionModel->create($fileName);

        move_uploaded_file($fileName, $destination);

        header('Location: /transactions');
       } catch (Exception $e) {
        throw new Exception("Error processing transaction: " . $e->getMessage());
       }

    }
}