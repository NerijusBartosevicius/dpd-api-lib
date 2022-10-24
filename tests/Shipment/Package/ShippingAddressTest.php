<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingAddressTest extends \PHPUnit\Framework\TestCase
{
    public function test_address_result(): void
    {
        $address = new \NeriBa\DpdApiLib\Shipment\Package\Address();
        $address->setName('Name');
        $address->setContactName('Contact name');
        $address->setContactEmail('Contact email');
        $address->setContactPhone('Contact phone');
        $address->setContactInfo('Contact info');
        $address->setEmail('Email');
        $address->setPhone('Phone');
        $address->setStreet('Street');
        $address->setStreetNo('Street no');
        $address->setFlatNo('Flat no');
        $address->setCity('City');
        $address->setPostalCode('Postal code');
        $address->setCountry('LT');
        $address->setPudoId('Pudo id');
        $address->setAddressId('Address id');

        $result = $address->get();

        $this->assertArrayHasKey('name', $result);
        $this->assertArrayHasKey('contactName', $result);
        $this->assertArrayHasKey('contactEmail', $result);
        $this->assertArrayHasKey('contactPhone', $result);
        $this->assertArrayHasKey('contactInfo', $result);
        $this->assertArrayHasKey('email', $result);
        $this->assertArrayHasKey('phone', $result);
        $this->assertArrayHasKey('street', $result);
        $this->assertArrayHasKey('streetNo', $result);
        $this->assertArrayHasKey('flatNo', $result);
        $this->assertArrayHasKey('city', $result);
        $this->assertArrayHasKey('postalCode', $result);
        $this->assertArrayHasKey('country', $result);
        $this->assertArrayHasKey('pudoId', $result);
        $this->assertArrayHasKey('addressId', $result);
    }
}