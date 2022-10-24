<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment\Package;

use NeriBa\DpdApiLib\DpdException;
use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;

class Parcel implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $parcelComponents = [];

    /**
     * @var array
     */
    private array $sizes = ['xs', 's', 'm', 'l', 'xl'];

    /**
     * @param float|int $weight
     *
     * @return Parcel
     */
    public function setWeight(float|int $weight): Parcel
    {
        $this->parcelComponents['weight'] = $weight;

        return $this;
    }

    /**
     * @param string $parcelNumber
     *
     * @return Parcel
     */
    public function setParcelNumber(string $parcelNumber): Parcel
    {
        $this->parcelComponents['parcelNumber'] = $parcelNumber;

        return $this;
    }

    /**
     * @param string $size
     *
     * @return Parcel
     * @throws DpdException
     */
    public function setSize(string $size): Parcel
    {
        $size = strtolower($size);
        if (!in_array($size, $this->sizes, true)) {
            throw new DpdException("$size is wrong value, allowed values:" . implode(',', $this->sizes));
        }
        $this->parcelComponents['size'] = $size;

        return $this;
    }

    /**
     * @param array $mpsReferences
     *
     * @return Parcel
     * @throws DpdException
     */
    public function setMpsReferences(array $mpsReferences): Parcel
    {
        if (count($mpsReferences) > 4) {
            throw new DpdException("Shipment parcels. Maximum mpsReferences count = 4");
        }

        $this->parcelComponents['mpsReferences'] = array_map(static fn($item) => (string)$item, $mpsReferences);

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->parcelComponents;
    }
}