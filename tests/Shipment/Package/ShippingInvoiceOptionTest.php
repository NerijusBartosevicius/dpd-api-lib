<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingInvoiceOptionTest extends \PHPUnit\Framework\TestCase
{
    public function test_pallet_result(): void
    {
        $invoiceOption = new \NeriBa\DpdApiLib\Shipment\Package\InvoiceOption();
        $invoiceOption->setGeneratesInvoice(true);
        $invoiceOption->setName('Name');
        $invoiceOption->setCompany('Company');
        $invoiceOption->setStreet('Street');
        $invoiceOption->setZip('Zip');
        $invoiceOption->setCountry('LT');

        $result = $invoiceOption->get();

        $this->assertArrayHasKey('generatesInvoice', $result);
        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('company', $result);
        $this->assertArrayHasKey('street', $result);
        $this->assertArrayHasKey('zip', $result);
        $this->assertArrayHasKey('country', $result);
    }
}