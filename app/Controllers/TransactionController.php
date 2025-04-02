<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Model\InsertTransaction;
use App\Model\Transaction;
use App\View;

class TransactionController
{
    private Transaction $transactionModel;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->transactionModel = new Transaction();
    }

    public function index(): View
    {
        $files = $this->getTransactionFiles(STORAGE_PATH);
        $transactions = [];
        if (!empty($files)) {
            foreach ($files as $file) {
                $transactions = array_merge($transactions, $this->getTransactions($file, [$this, 'extractTransaction']));
            }
            $insertTransaction = new InsertTransaction($this->transactionModel);
            if ($insertTransaction->registerBatch($transactions)) {
                $this->deleteProcessedFiles($files);
            }
        }
        $transactions = $this->transactionModel->getAll();
        $totals = $this->calculateTotals($transactions);
        return View::make('transactions', ['transactions' => $transactions, 'totals' => $totals]);
    }

    private function getTransactionFiles(string $dirPath): array
    {
        $files = [];

        foreach (scandir($dirPath) as $file) {
            if (is_dir($dirPath . $file) || str_starts_with($file, '.')) {
                continue;
            }

            $files[] = $dirPath . DIRECTORY_SEPARATOR . $file;
        }

        return $files;
    }

    private function getTransactions(string $fileName, ?callable $transactionHandler = null): array
    {
        if (! file_exists($fileName)) {
            trigger_error('File "' . $fileName . '" does not exist.', E_USER_ERROR);
        }

        $file = fopen($fileName, 'r');

        fgetcsv($file);

        $transactions = [];

        while (($transaction = fgetcsv($file)) !== false) {
            if ($transactionHandler !== null) {
                $transaction = $transactionHandler($transaction);
            }

            $transactions[] = $transaction;
        }

        return $transactions;
    }

    private function extractTransaction(array $transactionRow): array
    {
        [$date, $checkNumber, $description, $amount] = $transactionRow;

        $amount = (float) str_replace(['$', ','], '', $amount);
        $checkNumber = is_numeric($checkNumber) ? (int) $checkNumber : null;
        return [
            'date'        => $date,
            'checkNumber' => $checkNumber,
            'description' => $description,
            'amount'      => $amount,
        ];
    }

    private function calculateTotals(array $transactions): array
    {
        $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

        foreach ($transactions as $transaction) {
            $totals['netTotal'] += $transaction['amount'];

            if ($transaction['amount'] >= 0) {
                $totals['totalIncome'] += $transaction['amount'];
            } else {
                $totals['totalExpense'] += $transaction['amount'];
            }
        }

        return $totals;
    }

    private function deleteProcessedFiles(array $files): void
    {
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
                echo "Deleted: $file\n";
            }
        }
    }
}
