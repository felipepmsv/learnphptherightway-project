<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Models\Transaction;
use App\Services\TransactionService;
use App\View;

class TransactionsController
{
    private Transaction $transactionModel;
    private TransactionService $transactionService;

    public function __construct()
    {
        $this->transactionModel = new Transaction();
        $this->transactionService = new TransactionService($this->transactionModel);
    }

    public function index(): View
    {
        $transactions = $this->transactionModel->getAll();
        $totals = $this->transactionService->calculateTotals($transactions);

        return View::make('transactions', ['transactions' => $transactions, 'totals' => $totals]);
    }

    public function upload(): void
    {
        $this->transactionService->upload($_FILES);

        header('Location: /transactions/');
    }
}
