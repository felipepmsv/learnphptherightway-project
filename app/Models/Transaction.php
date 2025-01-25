<?php

namespace App\Models;

use App\Model;

class Transaction extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM transactions');

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function save(array $transactions): void
    {
        $stmt = $this->db->prepare('INSERT INTO transactions (date, check_number, description, amount) VALUES (?, ?, ?, ?)');

        foreach ($transactions as $transaction) {
            $stmt->execute([$transaction['date'], $transaction['check_number'], $transaction['description'], $transaction['amount']]);
        }
    }

    public function calculateTotals(array $transactions): array
    {
        $totals = [
            'income' => 0,
            'expense' => 0,
            'total' => 0,
        ];

        foreach ($transactions as $transaction) {
            $amount = $transaction['amount'];

            if($amount >= 0) {
                $totals['income'] += $amount;
            } else {
                $totals['expense'] += $amount;
            }

            $totals['total'] += $amount;
        }

        return $totals;
    }

    public function upload(array $files): void
    {
        $allTransactions = [];

        foreach ($files['tmp_name'] as $fileName) {
            $transactions = $this->parseCsv($fileName);

            $allTransactions = array_merge($allTransactions, $transactions);
        }

        $this->save($allTransactions);
    }

    public function parseCsv(string $csv): array
    {
        $transactions = [];

        $file = fopen($csv, 'r');

        // skip first line
        fgetcsv($file);

        while(($transaction = fgetcsv($file)) !== false) {
            $transactions[] = $this->extractTransaction($transaction);
        }

        return $transactions;
    }

    public function extractTransaction(array $transaction): array
    {
        [$date, $checkNumber, $description, $amount] = $transaction;

        // convert format 01/04/2021 to mysql date format 2021-01-04
        $date = \DateTime::createFromFormat('m/d/Y', $date)->format('Y-m-d');

        $amount = (float) str_replace(['$', ','], '', $amount);

        return [
            'date' => $date,
            'check_number' => $checkNumber,
            'description' => $description,
            'amount' => $amount,
        ];
    }
}