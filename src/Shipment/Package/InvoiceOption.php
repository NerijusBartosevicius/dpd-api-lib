<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment\Package;

use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;

class InvoiceOption implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $invoiceComponents = [
        'generatesInvoice' => false,
    ];

    /**
     * @param bool $generatesInvoice
     *
     * @return InvoiceOption
     */
    public function setGeneratesInvoice(bool $generatesInvoice): InvoiceOption
    {
        $this->invoiceComponents['generatesInvoice'] = $generatesInvoice;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return InvoiceOption
     */
    public function setName(string $name): InvoiceOption
    {
        $this->invoiceComponents['name'] = $name;

        return $this;
    }

    /**
     * @param string $company
     *
     * @return InvoiceOption
     */
    public function setCompany(string $company): InvoiceOption
    {
        $this->invoiceComponents['company'] = $company;

        return $this;
    }

    /**
     * @param string $street
     *
     * @return InvoiceOption
     */
    public function setStreet(string $street): InvoiceOption
    {
        $this->invoiceComponents['street'] = $street;

        return $this;
    }

    /**
     * @param string $zip
     *
     * @return InvoiceOption
     */
    public function setZip(string $zip): InvoiceOption
    {
        $this->invoiceComponents['zip'] = $zip;

        return $this;
    }

    /**
     * @param string $country
     *
     * @return InvoiceOption
     */
    public function setCountry(string $country): InvoiceOption
    {
        $this->invoiceComponents['country'] = $country;

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->invoiceComponents;
    }
}