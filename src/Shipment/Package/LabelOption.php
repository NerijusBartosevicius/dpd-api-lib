<?php

/**
 * @author: Nerijus Bartoševičius
 * @created: 2022-10-09
 */

namespace NeriBa\DpdApiLib\Shipment\Package;

use NeriBa\DpdApiLib\DpdException;
use NeriBa\DpdApiLib\Interfaces\GetComponentInterface;

class LabelOption implements GetComponentInterface
{
    /**
     * @var array
     */
    protected array $labelOptionComponents = [
        'downloadLabel' => false,
        'emailLabel' => false,
        'labelFormat' => 'application/pdf',
        'paperSize' => 'A4',
    ];

    /**
     * @var array
     */
    private array $labelFormats = ['application/pdf', 'image/png'];

    /**
     * @var array
     */
    private array $paperSizes = ['A4', 'A6'];

    /**
     * @param array $shipmentIds
     *
     * @return LabelOption
     */
    public function setShipmentIds(array $shipmentIds): LabelOption
    {
        $this->labelOptionComponents['shipmentIds'] = $shipmentIds;

        return $this;
    }

    /**
     * @param array $parcelNumbers
     *
     * @return LabelOption
     */
    public function setParcelNumbers(array $parcelNumbers): LabelOption
    {
        $this->labelOptionComponents['parcelNumbers'] = $parcelNumbers;

        return $this;
    }

    /**
     * @param int $offsetPosition
     *
     * @return LabelOption
     */
    public function setOffsetPosition(int $offsetPosition): LabelOption
    {
        $this->labelOptionComponents['offsetPosition'] = $offsetPosition;

        return $this;
    }

    /**
     * @param bool $downloadLabel
     *
     * @return LabelOption
     */
    public function setDownloadLabel(bool $downloadLabel): LabelOption
    {
        $this->labelOptionComponents['downloadLabel'] = $downloadLabel;

        return $this;
    }

    /**
     * @param bool $emailLabel
     *
     * @return LabelOption
     */
    public function setEmailLabel(bool $emailLabel): LabelOption
    {
        $this->labelOptionComponents['emailLabel'] = $emailLabel;

        return $this;
    }

    /**
     * @param string $labelFormat
     *
     * @return LabelOption
     * @throws DpdException
     */
    public function setLabelFormat(string $labelFormat): LabelOption
    {
        $labelFormat = strtolower($labelFormat);
        if (!in_array($labelFormat, $this->labelFormats, true)) {
            throw new DpdException(
                "$labelFormat format is wrong, allowed formats:" . implode(',', $this->labelFormats)
            );
        }
        $this->labelOptionComponents['labelFormat'] = $labelFormat;

        return $this;
    }

    /**
     * @param string $paperSize
     *
     * @return LabelOption
     * @throws DpdException
     */
    public function setPaperSize(string $paperSize): LabelOption
    {
        $paperSize = strtoupper($paperSize);
        if (!in_array($paperSize, $this->paperSizes, true)) {
            throw new DpdException(
                "$paperSize wrong value, allowed values:" . implode(',', $this->paperSizes)
            );
        }
        $this->labelOptionComponents['paperSize'] = $paperSize;

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->labelOptionComponents;
    }
}