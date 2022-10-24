<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class PalletTest extends \PHPUnit\Framework\TestCase
{
    public function test_pallet_result(): void
    {
        $pallet = new \NeriBa\DpdApiLib\Pickup\Package\Pallet();
        $pallet->setType('EUR');

        $this->assertArrayHasKey('type', $pallet->get());
    }
}