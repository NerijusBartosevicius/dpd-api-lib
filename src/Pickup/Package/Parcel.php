<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Pickup\Package;

use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;

class Parcel implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $parcelComponents = [];

    /**
     * @param int $count
     *
     * @return Parcel
     */
    public function setCount(int $count): Parcel
    {
        $this->parcelComponents['count'] = $count;

        return $this;
    }

    /**
     * @param float $weight
     *
     * @return Parcel
     */
    public function setWeight(float $weight): Parcel
    {
        $this->parcelComponents['weight'] = $weight;

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