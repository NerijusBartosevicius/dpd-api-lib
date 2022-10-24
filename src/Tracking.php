<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-11
 */

namespace NeriBa\DpdApiLib;

use NeriBa\DpdApiLib\Traits\EnvironmentSelector;

class Tracking
{
    use EnvironmentSelector;

    /**
     * @param string $token
     * @param string $env
     *
     * @throws DpdException
     */
    public function __construct(string $token = '', string $env = 'LT')
    {
        $this->chooseEnvironment($env);
        $this->apiToken = $token;
    }

    /**
     * @param array $pknr
     * @param int $detail
     * @param int $showAll
     * @param string $lang
     *
     * @return bool|string
     */
    public function getTracking(array $pknr = [], int $detail = 3,int $showAll = 1,string $lang = 'en'): bool|string
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl . '/tracking?' . http_build_query(
                    ['pknr' => implode('|', $pknr), 'detail' => $detail, 'show_all' => $showAll, 'lang' => $lang]
                ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                $this->apiToken ? 'Authorization: Bearer ' . $this->apiToken : null,
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $this->responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $response;
    }

    /**
     * @return array
     */
    protected function listEnvironments(): array
    {
        return [
            'LT' => 'https://status.dpd.lt/external',
            'LV' => 'https://status.dpd.lv/external',
            'EE' => 'https://status.dpd.ee/external',
        ];
    }
}