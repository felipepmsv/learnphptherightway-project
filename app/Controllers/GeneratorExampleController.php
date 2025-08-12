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
        echo '<pre>';
        print_r($this->ticketModel->all());
        echo '</pre>';
    }
}
