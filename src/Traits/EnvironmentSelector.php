<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-10
 */

namespace NeriBa\DpdApiLib\Traits;

use NeriBa\DpdApiLib\DpdException;

trait EnvironmentSelector
{
    protected string $apiUrl = 'https://esiunta.dpd.lt/api/v1';
    protected int $responseStatus = 0;

    /**
     * @param $env
     *
     * @return void
     * @throws DpdException
     */
    private function chooseEnvironment($env): void
    {
        $env = strtoupper($env);
        $environments = $this->listEnvironments();
        if (isset($environments[$env])) {
            $this->apiUrl = $environments[$env];
        } else {
            throw new DpdException('Wrong environment chosen. Possible environments:' . implode(',', array_keys($environments)));
        }
    }

    /**
     * @return array
     */
    protected function listEnvironments(): array
    {
        return [
            'LT' => 'https://esiunta.dpd.lt/api/v1',
            'LT_TEST' => 'https://sandbox-esiunta.dpd.lt/api/v1',
            'LV' => 'https://eserviss.dpd.lv/api/v1',
            'LV_TEST' => 'https://sandbox-eserviss.dpd.lv/api/v1',
            'EE' => 'https://telli.dpd.ee/api/v1',
            'EE_TEST' => 'https://sandbox-telli.dpd.ee/api/v1',
        ];
    }

    /**
     * @return int
     */
    public function getResponseStatus(): int
    {
        return $this->responseStatus;
    }
}