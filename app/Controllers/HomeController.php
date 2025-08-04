<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\App;
use App\Services\InvoiceService;
use App\View;
use App\Container;

class HomeController
{
    public function __construct(private InvoiceService $invoiceService)
    {
    }

    public function index(): View
    {
        // Exemplo de chamada ao InvoiceService usando
        // contêiner de dependências        
        $this->invoiceService->process([], 25);

        return View::make('index');
    }
}
