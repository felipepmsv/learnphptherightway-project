<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\App;
use App\Services\InvoiceService;
use App\View;
use App\Container;

class HomeController
{
    public function index(): View
    {
        // Exemplo de chamada ao InvoiceService usando 
        // contêiner de dependências
        (new Container())->get(InvoiceService::class)->process([], 25);

        return View::make('index');
    }
}
