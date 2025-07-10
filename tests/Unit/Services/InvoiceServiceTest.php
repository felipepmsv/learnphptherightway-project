<?php

declare(strict_types = 1);

namespace Tests\Unit\Services;

use \App\Services\InvoiceService;
use \App\Services\SalesTaxService;
use \App\Services\PaymentGatewayService;
use \App\Services\EmailService;
use PHPUnit\Framework\TestCase;

class InvoiceServiceTest extends TestCase
{
    /** @test */
    public function it_processes_invoice(): void
    {
        // As anotações abaixo são para o PHPStorm entender que 
        // SalesTaxService, PaymentGatewayService e EmailService 
        // são mocks, sem elas o VSCode não consegue entender,
        // indicando erro !!!

        /** @var SalesTaxService&\PHPUnit\Framework\MockObject\MockObject */
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        /** @var PaymentGatewayService&\PHPUnit\Framework\MockObject\MockObject */
        $gatewayServiceMock  = $this->createMock(PaymentGatewayService::class);
        /** @var EmailService&\PHPUnit\Framework\MockObject\MockObject */
        $emailServiceMock    = $this->createMock(EmailService::class);

        //var_dump($salesTaxServiceMock->calculate(25, []));
        //exit;

        $gatewayServiceMock->method('charge')->willReturn(true);

        // GIVEN invoice service
        $invoiceService = new InvoiceService($salesTaxServiceMock, $gatewayServiceMock, $emailServiceMock);

        $customer = ['name' => 'Gio'];
        $amount = 150;

        // WHEN process is called
        $result = $invoiceService->process($customer, $amount);

        // THEN assert invoice is processed successfully
        $this->assertTrue($result);

    }

}
