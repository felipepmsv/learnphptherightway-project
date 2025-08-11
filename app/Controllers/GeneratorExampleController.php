<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Models\Ticket;
use Generator;

class GeneratorExampleController
{
    public function __construct(private Ticket $ticketModel)
    {
    }

    public function index()
    {
        $numbers = $this->lazyRange(1, 3000000);

        foreach($numbers as $key => $number) {
            echo $key . ': ' . $number . '<br />';
        }
    }

    private function lazyRange(int $start, int $end): Generator
    {        
        for ($i = $start; $i <= $end; $i++) {
            yield $i;
        }
    }
}
