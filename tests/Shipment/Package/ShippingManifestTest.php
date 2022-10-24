<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingManifestTest extends \PHPUnit\Framework\TestCase
{
    public function test_manifest_result(): void
    {
        $manifest = new \NeriBa\DpdApiLib\Shipment\Package\Manifest();
        $manifest->setShipmentIds([]);
        $manifest->setParcelNumbers([]);

        $result = $manifest->get();

        $this->assertArrayHasKey('shipmentIds', $result);
        $this->assertArrayHasKey('parcelNumbers', $result);
    }
}