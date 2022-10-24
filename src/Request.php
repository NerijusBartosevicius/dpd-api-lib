<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib;

use NeriBa\DpdApiLib\Pickup\Pickup;
use NeriBa\DpdApiLib\Shipment\Package\LabelOption;
use NeriBa\DpdApiLib\Shipment\Package\Manifest;
use NeriBa\DpdApiLib\Traits\EnvironmentSelector;

class Request
{
    use EnvironmentSelector;

    /**
     * @var string
     */
    private string $apiToken;

    /**
     * @param string $token
     * @param string $env
     *
     * @throws DpdException
     */
    public function __construct(string $token, string $env = 'LT')
    {
        $this->chooseEnvironment($env);
        $this->apiToken = $token;
    }

    /**
     * Gets user information.
     *
     * @return bool|string
     * @throws DpdException
     */
    public function authMe(): bool|string
    {
        return $this->call('/auth/me');
    }

    /**
     * Gets a list of all active authorization tokens.
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getAuthTokenSecrets(): bool|string
    {
        return $this->call('/auth/token-secrets');
    }

    /**
     * This method deletes specific authorization tokens.
     *
     * @param $secretId
     *
     * @return bool|string
     * @throws DpdException
     */
    public function deleteAuthTokenSecrets($secretId): bool|string
    {
        if (!$secretId) {
            throw new DpdException('SecretId cannot be empty');
        }

        return $this->call(sprintf('/auth/token-secrets/%s', $secretId), 'DELETE');
    }

    /**
     * Gets list of shipments.
     *
     * @param array $params
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getShipments(array $params = []): bool|string
    {
        return $this->call('/shipments?' . http_build_query($params));
    }

    /**
     * To create shipments.
     *
     * @param array $params
     *
     * @return bool|string
     * @throws DpdException
     */
    public function createShipments(array $params): bool|string
    {
        if (count($params) > 50) {
            throw new DpdException('Maximum shipments count = 50');
        }

        return $this->call('/shipments', 'POST', array_map(static fn($item) => $item->get(), $params));
    }

    /**
     * Delete shipments by providing one or list of comma separated UUIDS\parcelNos.
     *
     * @param array $ids
     *
     * @return bool|string
     * @throws DpdException
     */
    public function deleteShipments(array $ids): bool|string
    {
        if (!$ids) {
            throw new DpdException('Ids cannot be empty');
        }
        return $this->call('/shipments', 'DELETE', ['ids' => implode(',', $ids)]);
    }

    /**
     * To create shipment label.
     *
     * @param LabelOption $labelOption
     *
     * @return bool|string
     * @throws DpdException
     */
    public function createShipmentsLabels(LabelOption $labelOption): bool|string
    {
        return $this->call('/shipments/labels', 'POST', $labelOption->get());
    }

    /**
     * Create shipment manifest.
     *
     * @param Manifest $manifest
     *
     * @return bool|string
     * @throws DpdException
     */
    public function createShipmentManifest(Manifest $manifest): bool|string
    {
        return $this->call('/shipments/manifests', 'POST', $manifest->get());
    }

    /**
     * Get shipment manifest by manifest uuid.
     *
     * @param $uuid
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getShipmentsManifestByManifest($uuid): bool|string
    {
        if (!$uuid) {
            throw new DpdException('Uuid cannot be empty');
        }

        return $this->call(sprintf('/shipments/manifests/%s', $uuid));
    }

    /**
     * Get shipment manifest by shipment uuid.
     *
     * @param $uuid
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getShipmentsManifestByShipment($uuid): bool|string
    {
        if (!$uuid) {
            throw new DpdException('Uuid cannot be empty');
        }

        return $this->call(sprintf('/shipments/%s/manifests', $uuid));
    }

    /**
     * Gets invoice by uuid.
     *
     * @param $uuid
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getInvoices($uuid): bool|string
    {
        if (!$uuid) {
            throw new DpdException('Uuid cannot be empty');
        }

        return $this->call(sprintf('/invoices/%s', $uuid));
    }

    /**
     * Find lockers based on given criteria.
     *
     * @param array $params
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getLockers(array $params = []): bool|string
    {
        return $this->call('/lockers?' . http_build_query($params));
    }

    /**
     * Gets list of payers by customer.
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getCustomerPayers(): bool|string
    {
        return $this->call('/customers/payers');
    }

    /**
     * To create pickup.
     *
     * @param Pickup $pickup
     *
     * @return bool|string
     * @throws DpdException
     */
    public function createPickup(Pickup $pickup): bool|string
    {
        return $this->call('/pickups', 'POST', $pickup->get());
    }

    /**
     * Get pickups by parameters.
     *
     * @param array $params
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getPickups(array $params = []): bool|string
    {
        return $this->call('/pickups?' . http_build_query($params));
    }

    /**
     * Gets list of pickup timeframes by given parameters.
     *
     * @param array $params
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getPickupTimeFrames(array $params = []): bool|string
    {
        return $this->call('/pickup-timeframes?' . http_build_query($params));
    }

    /**
     * Gets a description for a problem from the knowledge base.
     *
     * @param int $problemType
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getProblems(int $problemType): bool|string
    {
        if (empty($problemType)) {
            throw new DpdException('ProblemType cannot be empty');
        }

        return $this->call(sprintf('/problems/%s', $problemType));
    }

    /**
     * Get services and price for user.
     *
     * @param array $params
     *
     * @return bool|string
     * @throws DpdException
     */
    public function getServices(array $params = []): bool|string
    {
        return $this->call('/services?' . http_build_query($params));
    }

    /**
     * @param string $endpoint
     * @param string $method
     * @param array $params
     * @param string $contentType
     *
     * @return bool|string
     * @throws DpdException
     */
    private function call(string $endpoint = '', string $method = 'GET', array $params = [], string $contentType = 'application/json'): bool|string
    {
        if (!$endpoint) {
            throw new DpdException('Endpoint is empty');
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->apiUrl . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $this->apiToken,
                'Content-Type: ' . $contentType,
                'Accept: ' . $contentType
            ),
        ));

        $response = curl_exec($curl);
        $this->responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $response;
    }
}