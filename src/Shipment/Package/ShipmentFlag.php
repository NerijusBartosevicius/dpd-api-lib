<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment\Package;

use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;

class ShipmentFlag implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $shipmentFlagComponents = [
        'savesSenderAddress' => false,
        'savesReceiverAddress' => false,
        'savesReturnAddress' => false,
        'generatesDplPin' => false,
        'getsPrice' => false,
    ];

    /**
     * @param bool $savesSenderAddress
     *
     * @return ShipmentFlag
     */
    public function setSavesSenderAddress(bool $savesSenderAddress): ShipmentFlag
    {
        $this->shipmentFlagComponents['savesSenderAddress'] = $savesSenderAddress;

        return $this;
    }

    /**
     * @param bool $savesReceiverAddress
     *
     * @return ShipmentFlag
     */
    public function setSavesReceiverAddress(bool $savesReceiverAddress): ShipmentFlag
    {
        $this->shipmentFlagComponents['savesReceiverAddress'] = $savesReceiverAddress;

        return $this;
    }

    /**
     * @param bool $savesReturnAddress
     *
     * @return ShipmentFlag
     */
    public function setSavesReturnAddress(bool $savesReturnAddress): ShipmentFlag
    {
        $this->shipmentFlagComponents['savesReturnAddress'] = $savesReturnAddress;

        return $this;
    }

    /**
     * @param bool $generatesDplPin
     *
     * @return ShipmentFlag
     */
    public function setGeneratesDplPin(bool $generatesDplPin): ShipmentFlag
    {
        $this->shipmentFlagComponents['generatesDplPin'] = $generatesDplPin;

        return $this;
    }

    /**
     * @param bool $getsPrice
     *
     * @return ShipmentFlag
     */
    public function setGetsPrice(bool $getsPrice): ShipmentFlag
    {
        $this->shipmentFlagComponents['getsPrice'] = $getsPrice;

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->shipmentFlagComponents;
    }
}