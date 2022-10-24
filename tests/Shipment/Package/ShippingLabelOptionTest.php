<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-12
 */
class ShippingLabelOptionTest extends \PHPUnit\Framework\TestCase
{
    public function test_label_option_result(): void
    {
        $labelOption = new \NeriBa\DpdApiLib\Shipment\Package\LabelOption();
        $labelOption->setShipmentIds([]);
        $labelOption->setParcelNumbers([]);
        $labelOption->setOffsetPosition(1);
        $labelOption->setDownloadLabel(true);
        $labelOption->setEmailLabel(true);
        $labelOption->setLabelFormat('application/pdf');
        $labelOption->setPaperSize('a6');

        $result = $labelOption->get();

        $this->assertArrayHasKey('shipmentIds', $result);
        $this->assertArrayHasKey('parcelNumbers', $result);
        $this->assertArrayHasKey('offsetPosition', $result);
        $this->assertArrayHasKey('downloadLabel', $result);
        $this->assertArrayHasKey('emailLabel', $result);
        $this->assertArrayHasKey('labelFormat', $result);
        $this->assertArrayHasKey('paperSize', $result);
    }
}