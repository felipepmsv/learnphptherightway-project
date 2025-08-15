<?php

declare(strict_types=1);

namespace PHP_8_1_Examples\Enum;

class Payment
{
    private int $status;

    public function updateStatus(int $status): Payment {
        $this->status = $status;
        return $this;
    }

    public function status(): int {
        return $this->status;
    }
}
