<?php

declare(strict_types = 1);

namespace Tests\Unit\Services;

use \App\Services\InvoiceService;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{
    /** @test */
    public function it_processes_invoice(): void
    {
        // GIVEN invoice service
        $invoiceService = new InvoiceService();

        $customer = ['name' => 'Gio'];
        $amount = 150;

        // WHEN process is called
        $result = $invoiceService->process($customer, $amount);

        // THEN assert invoice is processed successfully
        $this->assertTrue($result);

    }

}
