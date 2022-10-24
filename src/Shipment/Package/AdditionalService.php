<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment\Package;

class AdditionalService extends Service
{
    /**
     * @param array $fields
     *
     * @return AdditionalService
     */
    public function setFields(array $fields): AdditionalService
    {
        $this->serviceComponents['fields'] = $fields;

        return $this;
    }
}