<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\TransactionModel;
use App\View;

class TransactionController
{
    public function index(): View
    {
        $transactionModel = new TransactionModel();
        $transactions = $transactionModel->getAllTransactions();
        $totals = $transactionModel->calculateTotals($transactions);
        
        return View::make('transactions', ['transactions' => $transactions, 'totals' => $totals]);
    }
}