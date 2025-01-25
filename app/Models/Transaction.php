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
}