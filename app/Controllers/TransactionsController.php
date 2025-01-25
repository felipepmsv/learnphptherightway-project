<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Helpers\Debug;
use App\Models\Transaction;
use App\View;

class TransactionsController
{
    private Transaction $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new Transaction();
    }

    public function index(): View
    {
        $transactions = $this->transactionModel->getAll();
        $totals = $this->transactionModel->calculateTotals($transactions);

        return View::make('transactions', ['transactions' => $transactions, 'totals' => $totals]);
    }

    public function upload()
    {
        $files = $_FILES['files'];

        $this->transactionModel->upload($files);

        header('Location: /transactions/');
    }
}
