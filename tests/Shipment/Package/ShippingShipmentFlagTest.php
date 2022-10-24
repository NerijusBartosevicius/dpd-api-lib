<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingShipmentFlagTest extends \PHPUnit\Framework\TestCase
{
    public function test_shipment_flag_result(): void
    {
        $shipmentFlag = new \NeriBa\DpdApiLib\Shipment\Package\ShipmentFlag();
        $shipmentFlag->setGetsPrice(true);
        $shipmentFlag->setGeneratesDplPin(true);
        $shipmentFlag->setSavesReceiverAddress(true);
        $shipmentFlag->setSavesReturnAddress(true);
        $shipmentFlag->setSavesSenderAddress(true);

        $result = $shipmentFlag->get();

        $this->assertArrayHasKey('savesSenderAddress', $result);
        $this->assertArrayHasKey('savesReceiverAddress', $result);
        $this->assertArrayHasKey('savesReturnAddress', $result);
        $this->assertArrayHasKey('generatesDplPin', $result);
        $this->assertArrayHasKey('getsPrice', $result);
    }
}