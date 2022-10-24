<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Pickup;

use NeriBa\DpdApiLib\DpdException;
use NeriBa\DpdApiLib\Pickup\Package\Pallet;
use NeriBa\DpdApiLib\Pickup\Package\Parcel;
use NeriBa\DpdApiLib\Shipment\Package\Address;
use NeriBa\DpdApiLib\Shipment\Package\Pickup as ShipmentPickup;


class Pickup extends ShipmentPickup
{
    /**
     * @param Address $address
     *
     * @return Pickup
     */
    public function setAddress(Address $address): Pickup
    {
        $this->pickupComponents['address'] = $address->get();

        return $this;
    }

    /**
     * @param array $shipmentIds
     *
     * @return Pickup
     */
    public function setShipmentIds(array $shipmentIds): Pickup
    {
        $this->pickupComponents['shipmentIds'] = $shipmentIds;

        return $this;
    }

    /**
     * @param int $count
     * @param float $weight
     *
     * @return Pickup
     */
    public function setParcel(int $count, float $weight): Pickup
    {
        $this->pickupComponents['parcel'] = (new Parcel())->setCount($count)->setWeight($weight)->get();

        return $this;
    }

    /**
     * @param array $pallets
     *
     * @return Pickup
     */
    public function setPallets(array $pallets): Pickup
    {
        foreach ($pallets as $pallet) {
            if (!$pallet instanceof Pallet) {
                throw new DpdException("pallet mus be instanceof NeriBa\DpdApiLib\Pickup\Package\Pallet object");
            }
            $this->pickupComponents['pallets'][] = $pallet->get();
        }

        return $this;
    }

    /**
     * @param int $payerCode
     *
     * @return Pickup
     */
    public function setPayerCode(int $payerCode): Pickup
    {
        $this->pickupComponents['payerCode'] = $payerCode;

        return $this;
    }

}