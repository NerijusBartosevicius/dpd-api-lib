<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment\Package;

use NeriBa\DpdApiLib\DpdException;
use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;

class Pallet implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $palletComponents = [];

    /**
     * @var array
     */
    private array $types = ['EUR', 'FIN'];

    /**
     * @param float|int $weight
     *
     * @return Pallet
     */
    public function setWeight(float|int $weight): Pallet
    {
        $this->palletComponents['weight'] = $weight;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return Pallet
     * @throws DpdException
     */
    public function setType(string $type): Pallet
    {
        $type = strtoupper($type);
        if (!in_array($type, $this->types, true)) {
            throw new DpdException("$type is wrong value, allowed values:" . implode(',', $this->types));
        }
        $this->palletComponents['type'] = $type;

        return $this;
    }

    /**
     * @param array $mpsReferences
     *
     * @return Pallet
     * @throws DpdException
     */
    public function setMpsReferences(array $mpsReferences): Pallet
    {
        if (count($mpsReferences) > 4) {
            throw new DpdException("Shipment parcels. Maximum mpsReferences count = 4");
        }

        $this->palletComponents['mpsReferences'] = array_map(static fn($item) => (string)$item, $mpsReferences);

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->palletComponents;
    }

}