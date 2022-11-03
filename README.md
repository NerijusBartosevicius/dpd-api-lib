# DPD Api library

DPD API library, to help to integrate with other systems

<p align="left">
<a href="https://packagist.org/packages/neriba/dpd-api-lib"><img src="https://img.shields.io/packagist/v/neriba/dpd-api-lib.svg?style=flat-square" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/neriba/dpd-api-lib"><img src="https://img.shields.io/packagist/dt/neriba/dpd-api-lib.svg?style=flat-square" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/neriba/dpd-api-lib"><img src="https://img.shields.io/packagist/l/neriba/dpd-api-lib" alt="License"></a>
</p>

## Official DPD docs
- [DPD Amber API](https://esiunta.dpd.lt/api/)
- [DPD API documentation](https://github.com/NerijusBartosevicius/dpd-api-lib/blob/main/docs/DPD-Telli-API-documentation-v1-1-3.pdf)
- [DPD tracking service](https://github.com/NerijusBartosevicius/dpd-api-lib/blob/main/docs/Shipment-status-tracking-web-service.pdf)

## Instalation

To install via composer:

```sh
composer require neriba/dpd-api-lib
```

## Authentication

#### Environments

- LT - Lithuania production (default).
- LT_TEST - Lithuania sandbox.
- LV - Latvia production.
- LV_TEST - Latvia sandbox.
- EE - Estonia production.
- EE_TEST - Estonia sandbox.

### Get new token

`If you don't have an API key from DPD, but you have an old API credencials name and password you can generate your own API key.`

```php
  // By default, third parameter is Lithuanian production environment
  $getToken = new \NeriBa\DpdApiLib\ApiTokenGenerator('USERNAME','PASSWORD','LT_TEST');
  $getToken->createAuthToken('Token name');
```

#### Create instance

```php       
  $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9....';
  // By default, third parameter is Lithuanian production environment
  $dpd = new \NeriBa\DpdApiLib\Request($token, 'LT_TEST');    
```

### Get user information

```php
  $dpd->authMe();
```

### Get list of tokens

```php  
  $dpd->getAuthTokenSecrets();
```

### Delete existing token

```php 
  $dpd->deleteAuthTokenSecrets('99bb2035-5ed8-4547-95ca-7ffb5e79e694');
```

## Services

### Get services and price for user

```php 
  // additional parameters are possible as an array e.g ['countryFrom' => 'LT', 'countryTo' => 'LT']
  // Parameters list: https://esiunta.dpd.lt/api#/Services/042db4934d823e1cc21745c549f2a810
  $dpd->getServices(['countryFrom' => 'LT', 'countryTo' => 'LT']);
```

## Shipment

### Get list of shipments

```php 
  // additional parameters are possible as an array e.g ['limit'=> 10]
  // Parameters list: https://esiunta.dpd.lt/api/#/Shipment/1aed3b00cafe6d7bd576b2b84b41826f
  $dpd->getShipments();
```

### Create simple shipment

```php        
  $senderAddress = new \NeriBa\DpdApiLib\Shipment\Package\Address();
  $senderAddress
      ->setName('Test Sender')
      ->setPhone('62166025')
      ->setStreet('Uosių g')
      ->setStreetNo(24)
      ->setCity('Kaunas')
      ->setPostalCode('51446')
      ->setCountry('LT');

  $receiverAddress = new \NeriBa\DpdApiLib\Shipment\Package\Address();
  $receiverAddress
      ->setName('Test Receiver')
      ->setPhone('65123456')
      ->setStreet('Uriekstes')
      ->setStreetNo(24)
      ->setCity('Kaunas')
      ->setPostalCode('51446')
      ->setCountry('LT');
    
  $shipment = new \NeriBa\DpdApiLib\Shipment\Shipment();    
  $shipment
      ->setSenderAddress($senderAddress)
      ->setReceiverAddress($receiverAddress)   
      ->setService((new \NeriBa\DpdApiLib\Shipment\Package\Service())->setServiceName('DPD CLASSIC'))    
      ->setParcel((new \NeriBa\DpdApiLib\Shipment\Package\Parcel())->setWeight(31)->setSize('XS'));
        
  $shipment2 = new \NeriBa\DpdApiLib\Shipment\Shipment();    
  $shipment2
      ->setSenderAddress($senderAddress)
      ->setReceiverAddress($receiverAddress)   
      ->setService((new \NeriBa\DpdApiLib\Shipment\Package\Service())->setServiceName('DPD CLASSIC'))    
      ->setParcel((new \NeriBa\DpdApiLib\Shipment\Package\Parcel())->setWeight(10)->setSize('m'));
        
  // Max 50 shipments per request
  $dpd->createShipments([$shipment,$shipment2]);        
```

### Delete shipments

```php 
$dpd->deleteShipments(['0fa01f06-7c56-4c5c-a33f-0eca869663f3','0fa01f06-7c56-4c5c-a33f-0eca869663f4']);
```

## Labels

### Create label

```php    
$dpd->createShipmentsLabels((new \NeriBa\DpdApiLib\Shipment\Package\LabelOption())->setShipmentIds(['0fa01f06-7c56-4c5c-a33f-0eca869663f3']));
```

## Invoice

### Gets invoice by uuid

```php    
$dpd->getInvoices('0fa01f06-7c56-4c5c-a33f-0eca869663f3');
```

## Lockers

### Find lockers based on given criteria

```php    
$dpd->getLockers(['countryCode' => 'LT']);
```

## Manifest

### Create shipment manifest

```php    
$dpd->createShipmentManifest((new \NeriBa\DpdApiLib\Shipment\Package\Manifest())->setShipmentIds(['0fa01f06-7c56-4c5c-a33f-0eca869663f3']));
```

### Get shipment manifest by uuid

```php    
$dpd->getShipmentsManifestByManifest('0fa01f06-7c56-4c5c-a33f-0eca869663f3');
```

### Get shipment manifest by shipment uuid

```php    
$dpd->getShipmentsManifestByShipment('0fa01f06-7c56-4c5c-a33f-0eca869663f3');
```

## Pickup

### Create pickup

```php    
$pickupAddress = new \NeriBa\DpdApiLib\Shipment\Package\Address();
$pickupAddress
    ->setName('Test Sender')
    ->setContactName('Test Sender cc')
    ->setEmail('john.doe@email.com')
    ->setPhone('+37062166025')
    ->setStreet('Uosių g')
    ->setStreetNo(24)
    ->setCity('Kaunas')
    ->setPostalCode('51446')
    ->setCountry('LT');

$pickup = new \NeriBa\DpdApiLib\Pickup\Pickup();
$pickup
    ->setPallets([(new \NeriBa\DpdApiLib\Pickup\Package\Pallet())->setWeight(150)->setCount(1)])
    ->setAddress($pickupAddress)
    ->setPickupDate('2022-10-12')
    ->setPickupTime('11:00', '15:00');
    
$dpd->createPickup($pickup);
```

### Get pickups

```php    
// additional parameters are possible as an array e.g ['limit'=> 10]
// Parameters list: https://esiunta.dpd.lt/api/#/Pickup/50e315fc1327d9f9a55db05ef66b4b48
$dpd->getPickups();
```

### Get list of pickup timeframes

```php    
// additional parameters are possible as an array e.g ['country' => 'LT','zip' => 51336]
// Parameters list: https://esiunta.dpd.lt/api/#/Pickup%20timeframes/e092e35374638c464b1e0b3eaa7513d9
$dpd->getPickupTimeFrames(['country' => 'LT','zip' => 51336]);
```

## Problem

### Get a description for a problem from the knowledge base

```php    
$dpd->getProblems(123456);
```

## Tracking

#### Environments

- LT - Lithuania production (default).
- LV - Latvia production.
- EE - Estonia production.

### Get tracking info by parcel numbers

`NOTE: Now tracking working without authorization,although the documentation says that it is used Bearer.`

```php
$apiKey = '';
// By default, second parameter is Lithuanian production environment
$tracking = new \NeriBa\DpdApiLib\Tracking($apiKey,'LT');
$tracking->getTracking(['05808021421108','05808021421105']);
```

# License

The MIT License (MIT). Please see [License File](LICENSE) for more information.