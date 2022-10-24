<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment;

use NeriBa\DpdApiLib\DpdException;
use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;
use NeriBa\DpdApiLib\Shipment\Package\AdditionalService;
use NeriBa\DpdApiLib\Shipment\Package\Address;
use NeriBa\DpdApiLib\Shipment\Package\InvoiceOption;
use NeriBa\DpdApiLib\Shipment\Package\LabelOption;
use NeriBa\DpdApiLib\Shipment\Package\Pallet;
use NeriBa\DpdApiLib\Shipment\Package\Parcel;
use NeriBa\DpdApiLib\Shipment\Package\Pickup;
use NeriBa\DpdApiLib\Shipment\Package\Service;
use NeriBa\DpdApiLib\Shipment\Package\ShipmentFlag;

class Shipment implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $shipmentComponents = [
        'parcels' => [],
        'pallets' => []
    ];

    /**
     * @param Address $address
     *
     * @return Shipment
     */
    public function setSenderAddress(Address $address): Shipment
    {
        $this->shipmentComponents['senderAddress'] = $address->get();

        return $this;
    }

    /**
     * @param Address $address
     *
     * @return Shipment
     */
    public function setReceiverAddress(Address $address): Shipment
    {
        $this->shipmentComponents['receiverAddress'] = $address->get();

        return $this;
    }

    /**
     * @param Address $address
     *
     * @return Shipment
     */
    public function setReturnAddress(Address $address): Shipment
    {
        $this->shipmentComponents['returnAddress'] = $address->get();

        return $this;
    }

    /**
     * @param int $payerCode
     *
     * @return Shipment
     */
    public function setPayerCode(int $payerCode): Shipment
    {
        $this->shipmentComponents['payerCode'] = $payerCode;

        return $this;
    }

    /**
     * @param Service $service
     *
     * @return Shipment
     */
    public function setService(Service $service): Shipment
    {
        $this->shipmentComponents['service'] = $service->get();

        return $this;
    }

    /**
     * @param AdditionalService $additionalService
     *
     * @return Shipment
     */
    public function setAdditionalService(AdditionalService $additionalService): Shipment
    {
        $this->shipmentComponents['additionalServices'][] = $additionalService->get();

        return $this;
    }

    /**
     * @param array $additionalServices
     *
     * @return Shipment
     */
    public function setAdditionalServices(array $additionalServices): Shipment
    {
        foreach ($additionalServices as $additionalService) {
            $this->setAdditionalService($additionalService);
        }
        return $this;
    }

    /**
     * @param Parcel $parcel
     *
     * @return Shipment
     * @throws DpdException
     */
    public function setParcel(Parcel $parcel): Shipment
    {
        if (count($this->shipmentComponents['parcels']) >= 50) {
            throw new DpdException("Shipment parcels. Maximum parcel count = 50");
        }

        $this->shipmentComponents['parcels'][] = $parcel->get();

        return $this;
    }

    /**
     * @param array $parcels
     *
     * @return Shipment
     * @throws DpdException
     */
    public function setParcels(array $parcels): Shipment
    {
        foreach ($parcels as $parcel) {
            $this->setParcel($parcel);
        }

        return $this;
    }

    /**
     * @param Pallet $pallet
     *
     * @return Shipment
     * @throws DpdException
     */
    public function setPallet(Pallet $pallet): Shipment
    {
        $this->shipmentComponents['pallets'][] = $pallet->get();

        return $this;
    }

    /**
     * @param array $pallets
     *
     * @return Shipment
     * @throws DpdException
     */
    public function setPallets(array $pallets): Shipment
    {
        foreach ($pallets as $pallet) {
            $this->setPallet($pallet);
        }

        return $this;
    }

    /**
     * @param Pickup $pickup
     *
     * @return Shipment
     */
    public function setPickup(Pickup $pickup): Shipment
    {
        $this->shipmentComponents['pickup'] = $pickup->get();

        return $this;
    }

    /**
     * @param string $contentDescription
     *
     * @return Shipment
     */
    public function setContentDescription(string $contentDescription): Shipment
    {
        $this->shipmentComponents['contentDescription'] = $contentDescription;

        return $this;
    }

    /**
     * @param array $shipmentReferences
     *
     * @return Shipment
     * @throws DpdException
     */
    public function setShipmentReferences(array $shipmentReferences): Shipment
    {
        if (count($shipmentReferences) > 4) {
            throw new DpdException("Shipment parcels. Maximum shipmentReferences count = 4");
        }

        $this->shipmentComponents['shipmentReferences'] = array_map(
            static fn($item) => (string)$item,
            $shipmentReferences
        );

        return $this;
    }

    /**
     * @param string $additionalInfo
     *
     * @return Shipment
     */
    public function setAdditionalInfo(string $additionalInfo): Shipment
    {
        $this->shipmentComponents['additionalInfo'] = $additionalInfo;

        return $this;
    }

    /**
     * @param ShipmentFlag $shipmentFlags
     *
     * @return Shipment
     */
    public function setShipmentFlags(ShipmentFlag $shipmentFlags): Shipment
    {
        $this->shipmentComponents['shipmentFlags'] = $shipmentFlags->get();

        return $this;
    }

    /**
     * @param InvoiceOption $invoiceOption
     *
     * @return Shipment
     */
    public function setInvoiceOptions(InvoiceOption $invoiceOptions): Shipment
    {
        $this->shipmentComponents['invoiceOptions'] = $invoiceOptions->get();

        return $this;
    }

    /**
     * @param LabelOption $labelOptions
     *
     * @return Shipment
     */
    public function setLabelOptions(LabelOption $labelOptions): Shipment
    {
        $this->shipmentComponents['labelOptions'] = $labelOptions->get();

        return $this;
    }

    /**
     * @param string $mpsId
     *
     * @return Shipment
     */
    public function setMpsId(string $mpsId): Shipment
    {
        $this->shipmentComponents['mpsId'] = $mpsId;

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->shipmentComponents;
    }
}