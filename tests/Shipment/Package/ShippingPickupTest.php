<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingPickupTest extends \PHPUnit\Framework\TestCase
{
    public function test_pickup_result()
    {
        $pickup = new \NeriBa\DpdApiLib\Shipment\Package\Pickup();
        $pickup->setPickupDate(date('Y-m-d'));
        $pickup->setPickupTime('15:00', '18:00');
        $pickup->setMessageToCourier('Message');

        $result = $pickup->get();

        $this->assertArrayHasKey('pickupDate', $result);
        $this->assertArrayHasKey('messageToCourier', $result);
        $this->assertArrayHasKey('pickupTimeFrom', $result);
        $this->assertArrayHasKey('pickupTimeTo', $result);
    }
}