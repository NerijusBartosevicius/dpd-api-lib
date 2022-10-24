<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment\Package;

use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;

class Service implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $serviceComponents = [];

    /**
     * @param string $serviceName
     *
     * @return Service
     */
    public function setServiceName(string $serviceName): Service
    {
        $this->serviceComponents['serviceAlias'] = $serviceName;

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->serviceComponents;
    }
}