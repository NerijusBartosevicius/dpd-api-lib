<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment\Package;

use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;

class Manifest implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $manifestComponents = [];

    /**
     * @param array $shipmentIds
     *
     * @return Manifest
     */
    public function setShipmentIds(array $shipmentIds): Manifest
    {
        $this->manifestComponents['shipmentIds'] = $shipmentIds;

        return $this;
    }

    /**
     * @param array $parcelNumbers
     *
     * @return Manifest
     */
    public function setParcelNumbers(array $parcelNumbers): Manifest
    {
        $this->manifestComponents['parcelNumbers'] = $parcelNumbers;

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->manifestComponents;
    }
}