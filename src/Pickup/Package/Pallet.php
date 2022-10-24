<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Pickup\Package;

use NeriBa\DpdApiLib\DpdException;

class Pallet extends Parcel
{
    /**
     * @var array
     */
    protected array $types = ['EUR', 'FIN'];

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
        $this->parcelComponents['type'] = $type;

        return $this;
    }
}