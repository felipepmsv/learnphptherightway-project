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
        $numbers = range(1, 3000000);

        echo '<pre>';
        print_r($numbers);
        echo '</pre>';
    }

    private function lazyRange(int $start, int $end): Generator
    {
        for ($i = $start; $i <= $end; $i++) {
            yield $i;
        }
    }
}
