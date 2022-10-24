<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingParcelTest extends \PHPUnit\Framework\TestCase
{
    public function test_parcel_result(): void
    {
        $parcel = new \NeriBa\DpdApiLib\Shipment\Package\Parcel();
        $parcel->setWeight(10);
        $parcel->setSize('xs');
        $parcel->setParcelNumber('parcel number');
        $parcel->setMpsReferences([]);

        $result = $parcel->get();

        $this->assertArrayHasKey('weight', $result);
        $this->assertArrayHasKey('parcelNumber', $result);
        $this->assertArrayHasKey('mpsReferences', $result);
        $this->assertArrayHasKey('size', $result);
    }
}