<?php

namespace App\Services;

use App\Exceptions\FileUploadException;
use App\Models\Transaction;

class TransactionService
{
    public function __construct(private Transaction $transactionModel)
    {

    }

    /**
     * @throws FileUploadException
     */
    public function upload(array $files): void
    {
        if(empty($files)) {
            throw new FileUploadException('File was not uploaded');
        }

        $files = $files['files'];

        $allTransactions = [];

        for ($i = 0; $i < count($files['name']); $i++) {
            $fileName = $files['tmp_name'][$i];
            $fileError = $files['error'][$i];

            if(!($fileError === UPLOAD_ERR_OK)) {
                throw new FileUploadException('Error while uploading file');
            }

            $transactions = $this->parseCsv($fileName);

            $allTransactions = array_merge($allTransactions, $transactions);
        }

        $this->transactionModel->save($allTransactions);
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