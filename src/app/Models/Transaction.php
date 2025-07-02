<?php

declare(strict_types = 1);

namespace App\Models;

use PDO;

class Transaction extends \App\Model
{

    public function find(int $id) : ?array
    {
        $query = 'SELECT * FROM transactions WHERE id = ?';

        $stmt = $this->db->prepare($query);
        //$stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(string $transData,
            string $transNumb,
            string $transDesc,
            string $transAmnt) : int
    {
        // Date, Check #, Description, Amount
        $query = 'INSERT INTO transactions (transaction_date, check_number, description, amount) 
                    VALUES (:transaction_date, :check_number, :description, :amount)';

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':transaction_date', $transData, PDO::PARAM_STR);
        $stmt->bindParam(':check_number', $transNumb, PDO::PARAM_STR);
        $stmt->bindParam(':description', $transDesc, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $transAmnt, PDO::PARAM_STR);

        $stmt->execute();

        return (int) $this->db->lastInsertId();
    }

}
