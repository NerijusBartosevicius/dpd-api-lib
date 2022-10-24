<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingAdditionalServiceTest extends \PHPUnit\Framework\TestCase
{
    public function test_additional_service_result(): void
    {
        $additionalService = new \NeriBa\DpdApiLib\Shipment\Package\AdditionalService();
        $additionalService->setFields([]);

        $this->assertArrayHasKey('fields', $additionalService->get());
    }
}