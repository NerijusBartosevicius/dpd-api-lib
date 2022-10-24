<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingServiceTest extends \PHPUnit\Framework\TestCase
{
    public function test_service_result(): void
    {
        $service = new \NeriBa\DpdApiLib\Shipment\Package\Service();
        $service->setServiceName('DPD CLASSIC');

        $this->assertArrayHasKey('serviceAlias', $service->get());
    }
}