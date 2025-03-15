<?php

declare(strict_types=1);

namespace App\Models;

use App\DB;
use App\App;
use App\Helpers;

class TransactionModel
{
    private DB $db;

    public function __construct()
    {
        $this->db = App::db();
    }

    public function create(string $fileName)
    {
        $file = fopen($fileName, 'r');
        
        fgetcsv($file, 0, ',', '"', '\\');
        
        $stmt = $this->db->prepare(
            'INSERT INTO transactions (date, check_number, description, amount) 
            VALUES(?, ?, ?, ?)')
        ;
        while (($transaction = fgetcsv($file, 0, ',', '"', '\\')) !== false) {
            $transaction = $this->extractTransaction($transaction);
            $date = $transaction['date'];
            $checkNumber = $transaction['checkNumber'];
            $description = $transaction['description'];
            $amount = $transaction['amount'];

            $stmt->execute([$date, $checkNumber, $description, $amount]);
        }
        
    }

    public function getAllTransactions()
    {
        $stmt = $this->db->prepare('SELECT date, check_number, description, amount FROM transactions');
        $stmt->execute();
        $transactions = $stmt->fetchAll();
        $formattedTransactions = [];

        foreach ($transactions as $transaction) {
            $transaction = array_values($transaction);

            $formatted = $this->extractTransaction($transaction, true, true);
            $formatted['rawAmount'] = (float) str_replace(['$', ','], '', $transaction[3]);
            $formattedTransactions[] = $formatted;
        }
        
        return $formattedTransactions;
    }

    private function extractTransaction(array $transactionRow, bool $formatDate = false, bool $formatDollar = false): array
    {
        [$date, $checkNumber, $description, $amount] = $transactionRow;

        $amount = (float) str_replace(['$', ','], '', $amount);
        $amountClass = $amount > 0 ? 'text-success' : ($amount < 0 ? 'text-danger' : 'text-normal');

        return [
            'date' => $formatDate ? Helpers::formateDate($date) : $date,
            'checkNumber' => $checkNumber,
            'description' => $description,
            'amount' => $formatDollar ? Helpers::formatDollar($amount): $amount,
            'amountClass' => $amountClass
        ];
    }

    public function calculateTotals(array $transactions) 
    {
        $totals = ['netTotal' => 0, 'totalExpense' => 0, 'totalIncome' => 0];

        foreach ($transactions as $transaction) {

            $amount = $transaction['rawAmount'] ?? $transaction['amount'];

            $totals['netTotal'] += $amount;

            if ($amount > 0) {
                $totals['totalIncome'] += $amount;
            } else {
                $totals['totalExpense'] += $amount;
            }
        }

        $totals['netTotal'] = Helpers::formatDollar($totals['netTotal']);
        $totals['totalIncome'] = Helpers::formatDollar($totals['totalIncome']);
        $totals['totalExpense'] = Helpers::formatDollar($totals['totalExpense']);
        return $totals;
    }
}