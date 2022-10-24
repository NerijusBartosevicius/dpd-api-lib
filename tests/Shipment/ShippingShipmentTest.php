<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingShipmentTest extends \PHPUnit\Framework\TestCase
{
    public function test_shipment_result(): void
    {
        $senderAddress = new \NeriBa\DpdApiLib\Shipment\Package\Address();
        $senderAddress
            ->setName('Test Sender')
            ->setPhone('62166025')
            ->setStreet('Uosių g')
            ->setStreetNo(24)
            ->setCity('Kaunas')
            ->setPostalCode('51446')
            ->setCountry('LT');

        $receiverAddress = new \NeriBa\DpdApiLib\Shipment\Package\Address();
        $receiverAddress
            ->setName('Test Receiver')
            ->setPhone('65123456')
            ->setStreet('Uriekstes')
            ->setStreetNo(24)
            ->setCity('Kaunas')
            ->setPostalCode('51446')
            ->setCountry('LT');

        $returnAddress = new \NeriBa\DpdApiLib\Shipment\Package\Address();
        $returnAddress
            ->setName('Test Return')
            ->setPhone('65123456')
            ->setStreet('Laisvės')
            ->setStreetNo(24)
            ->setCity('Vilnius')
            ->setPostalCode('51446')
            ->setCountry('LT');

        $shipment = new \NeriBa\DpdApiLib\Shipment\Shipment();
        $shipment->setSenderAddress($senderAddress)
            ->setReceiverAddress($receiverAddress)
            ->setReturnAddress($returnAddress)
            ->setPayerCode(123456789)
            ->setService((new \NeriBa\DpdApiLib\Shipment\Package\Service())->setServiceName('DPD CLASSIC'))
            ->setAdditionalService((new \NeriBa\DpdApiLib\Shipment\Package\AdditionalService())->setServiceName('COD'))
            ->setPickup((new \NeriBa\DpdApiLib\Shipment\Package\Pickup())->setPickupDate('2022-10-11')->setPickupTime('15:00','18:00'))
            ->setContentDescription('Content description')
            ->setShipmentReferences([])
            ->setAdditionalInfo('Additional info')
            ->setShipmentFlags((new \NeriBa\DpdApiLib\Shipment\Package\ShipmentFlag()))
            ->setInvoiceOptions((new \NeriBa\DpdApiLib\Shipment\Package\InvoiceOption()))
            ->setLabelOptions((new \NeriBa\DpdApiLib\Shipment\Package\LabelOption()))
            ->setMpsId('Maps id');

        $result = $shipment->get();

        $this->assertArrayHasKey('senderAddress', $result);
        $this->assertArrayHasKey('receiverAddress', $result);
        $this->assertArrayHasKey('returnAddress', $result);
        $this->assertArrayHasKey('payerCode', $result);
        $this->assertArrayHasKey('service', $result);
        $this->assertArrayHasKey('additionalServices', $result);
        $this->assertArrayHasKey('parcels', $result);
        $this->assertArrayHasKey('pallets', $result);
        $this->assertArrayHasKey('pickup', $result);
        $this->assertArrayHasKey('contentDescription', $result);
        $this->assertArrayHasKey('shipmentReferences', $result);
        $this->assertArrayHasKey('additionalInfo', $result);
        $this->assertArrayHasKey('shipmentFlags', $result);
        $this->assertArrayHasKey('invoiceOptions', $result);
        $this->assertArrayHasKey('labelOptions', $result);
        $this->assertArrayHasKey('mpsId', $result);
    }
}