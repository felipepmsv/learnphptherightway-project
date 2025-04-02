<?php

declare(strict_types=1);

namespace App\Model;

use App\Model;

class Transaction extends Model
{
    public function create(string $date, ?int $check = null, string $description, float $amount)
    {
        $formattedDate = (new \DateTime($date))->format('Y-m-d');
        $newTransaction = $this->db->prepare(
            'INSERT INTO transactions (`date`, `check`, `description`, amount) VALUES (?,?,?,?)'
        );
        $newTransaction->execute([$formattedDate, $check, $description, $amount]);
    }

    public function getAll()
    {
        $stmt =  $this->db->prepare(
            'SELECT * FROM transactions'
        );
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
