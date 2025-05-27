<?php

namespace App;

class CollectionAgency implements DebtCollector
{    
    public function collect(float $owedAmount): float
    {
        $guaranteed = $owedAmount * 0.5; // 50% guaranteed collection

        return mt_rand($guaranteed, $owedAmount);
    } 
}