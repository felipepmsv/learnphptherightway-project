<?php

declare(strict_types=1);

namespace App\Model;

use App\Model;

class InsertTransaction extends Model
{
    /**
     * Class constructor.
     */
    public function __construct(protected Transaction $transactionModel)
    {
        parent::__construct();
    }

    public function registerBatch(array $transactions): bool
    {
        try {
            $this->db->beginTransaction();
            foreach ($transactions as $transaction) {
                $this->transactionModel->create($transaction['date'], $transaction['checkNumber'], $transaction['description'], $transaction['amount']);
            }
            $this->db->commit();
            return true;
        } catch (\Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            throw $e;
        }
        return false;
    }
}
