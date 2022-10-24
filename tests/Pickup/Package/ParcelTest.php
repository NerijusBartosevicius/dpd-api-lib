<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ParcelTest extends \PHPUnit\Framework\TestCase
{
    public function test_parcel_result(): void
    {
        $parcel = new \NeriBa\DpdApiLib\Pickup\Package\Parcel();
        $parcel->setCount(10);
        $parcel->setWeight(15);

        $result = $parcel->get();

        $this->assertArrayHasKey('count', $result);
        $this->assertArrayHasKey('weight', $result);
    }

}