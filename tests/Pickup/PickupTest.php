<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class PickupTest extends \PHPUnit\Framework\TestCase
{
    public function test_pallet_result(): void
    {
        $pickupAddress = new \NeriBa\DpdApiLib\Shipment\Package\Address();
        $pickupAddress
            ->setName('Test Sender')
            ->setContactName('Test Sender cc')
            ->setEmail('john.doe@email.com')
            ->setPhone('+37062166025')
            ->setStreet('Uosių g')
            ->setStreetNo(24)
            ->setCity('Kaunas')
            ->setPostalCode('51446')
            ->setCountry('LT');

        $pickup = new \NeriBa\DpdApiLib\Pickup\Pickup();
        $pickup
            ->setAddress($pickupAddress)
            ->setShipmentIds([])
            ->setPallets([(new \NeriBa\DpdApiLib\Pickup\Package\Pallet())->setWeight(150)->setCount(1)])
            ->setParcel(1, 5)
            ->setPayerCode(123456789);

        $result = $pickup->get();

        $this->assertArrayHasKey('address', $result);
        $this->assertArrayHasKey('shipmentIds', $result);
        $this->assertArrayHasKey('parcel', $result);
        $this->assertArrayHasKey('pallets', $result);
        $this->assertArrayHasKey('payerCode', $result);
    }
}