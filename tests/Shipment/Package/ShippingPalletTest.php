<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingPalletTest extends \PHPUnit\Framework\TestCase
{
    public function test_pallet_result(): void
    {
        $pallet = new \NeriBa\DpdApiLib\Shipment\Package\Pallet();
        $pallet->setWeight(10);
        $pallet->setType('eur');
        $pallet->setMpsReferences([]);

        $result = $pallet->get();

        $this->assertArrayHasKey('weight', $result);
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('mpsReferences', $result);
    }
}