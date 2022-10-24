<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment\Package;

use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;

class Address implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $addressComponents = [];

    /**
     * @param string $name
     *
     * @return Address
     */
    public function setName(string $name): Address
    {
        $this->addressComponents['name'] = $name;

        return $this;
    }

    /**
     * @param string $contactName
     *
     * @return Address
     */
    public function setContactName(string $contactName): Address
    {
        $this->addressComponents['contactName'] = $contactName;

        return $this;
    }

    /**
     * @param string $contactEmail
     *
     * @return Address
     */
    public function setContactEmail(string $contactEmail): Address
    {
        $this->addressComponents['contactEmail'] = $contactEmail;

        return $this;
    }

    /**
     * @param string $contactPhone
     *
     * @return Address
     */
    public function setContactPhone(string $contactPhone): Address
    {
        $this->addressComponents['contactPhone'] = $contactPhone;

        return $this;
    }

    /**
     * @param string $contactInfo
     *
     * @return Address
     */
    public function setContactInfo(string $contactInfo): Address
    {
        $this->addressComponents['contactInfo'] = $contactInfo;

        return $this;
    }

    /**
     * @param string $email
     *
     * @return Address
     */
    public function setEmail(string $email): Address
    {
        $this->addressComponents['email'] = $email;

        return $this;
    }

    /**
     * @param string $phone
     *
     * @return Address
     */
    public function setPhone(string $phone): Address
    {
        $this->addressComponents['phone'] = $phone;

        return $this;
    }

    /**
     * @param string $street
     *
     * @return Address
     */
    public function setStreet(string $street): Address
    {
        $this->addressComponents['street'] = $street;

        return $this;
    }

    /**
     * @param string $streetNo
     *
     * @return Address
     */
    public function setStreetNo(string $streetNo): Address
    {
        $this->addressComponents['streetNo'] = $streetNo;

        return $this;
    }

    /**
     * @param string $flatNo
     *
     * @return Address
     */
    public function setFlatNo(string $flatNo): Address
    {
        $this->addressComponents['flatNo'] = $flatNo;

        return $this;
    }

    /**
     * @param string $city
     *
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->addressComponents['city'] = $city;

        return $this;
    }

    /**
     * @param string $postalCode
     *
     * @return Address
     */
    public function setPostalCode(string $postalCode): Address
    {
        $this->addressComponents['postalCode'] = $postalCode;

        return $this;
    }

    /**
     * @param string $country
     *
     * @return Address
     */
    public function setCountry(string $country): Address
    {
        $this->addressComponents['country'] = $country;

        return $this;
    }

    /**
     * @param string $pudoId
     *
     * @return Address
     */
    public function setPudoId(string $pudoId): Address
    {
        $this->addressComponents['pudoId'] = $pudoId;

        return $this;
    }

    /**
     * @param string $addressId
     *
     * @return Address
     */
    public function setAddressId(string $addressId): Address
    {
        $this->addressComponents['addressId'] = $addressId;

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->addressComponents;
    }
}