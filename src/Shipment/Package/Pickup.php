<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment\Package;

use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;

class Pickup implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $pickupComponents = [];

    /**
     * @param string $pickupDate
     *
     * @return Pickup
     */
    public function setPickupDate(string $pickupDate): Pickup
    {
        $this->pickupComponents['pickupDate'] = $pickupDate;

        return $this;
    }

    /**
     * @param string $messageToCourier
     *
     * @return Pickup
     */
    public function setMessageToCourier(string $messageToCourier): Pickup
    {
        $this->pickupComponents['messageToCourier'] = $messageToCourier;

        return $this;
    }

    /**
     * @param string $pickupTimeFrom
     * @param string $pickupTimeTo
     *
     * @return Pickup
     */
    public function setPickupTime(string $pickupTimeFrom, string $pickupTimeTo): Pickup
    {
        $this->pickupComponents['pickupTimeFrom'] = $pickupTimeFrom;
        $this->pickupComponents['pickupTimeTo'] = $pickupTimeTo;

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->pickupComponents;
    }
}