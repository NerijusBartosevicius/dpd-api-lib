<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib;

use NeriBa\DpdApiLib\Traits\EnvironmentSelector;

class ApiTokenGenerator
{
    use EnvironmentSelector;

    /**
     * @param string $username
     * @param string $password
     * @param string $env
     *
     * @throws DpdException
     */
    public function __construct(private string $username, private string $password, string $env = 'LT')
    {
        $this->chooseEnvironment($env);
    }

    /**
     * Gets a new token, accepts basic auth/tokens
     *
     * @param string $tokenName
     * @param int $ttl
     *
     * @return bool|string
     */
    public function createAuthToken(string $tokenName, int $ttl = 999999999): bool|string
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl . '/auth/tokens',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(['name' => $tokenName, 'ttl' => $ttl]),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic ' . base64_encode($this->username . ':' . $this->password),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $this->responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $response;
    }
}