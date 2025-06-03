<?php

declare(strict_types=1);

namespace App\Domain\Address;

use JsonSerializable;

class Address implements JsonSerializable
{
    private ?int $id;
    private $addressOne;
    private $addressTwo;
    private $city;
    private $state;
    private $zipCode;
    private $country;

    public function __construct($id, $addressOne, $addressTwo, $city, $state, $zipCode, $country)
    {
        $this->id = $id;
        $this->addressOne = $addressOne;
        $this->addressTwo = $addressTwo;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        $this->country = $country;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAddressOne()
    {
        return $this->addressOne;
    }

    public function getAddressTwo()
    {
        return $this->addressTwo;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function getCountry()
    {
        return $this->country;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
        'id' => $this->id,
        'addressOne' => $this->addressOne,
        'addressTwo' => $this->addressTwo,
        'city' => $this->city,
        'state' => $this->state,
        'zipCode' => $this->zipCode,
        'country' => $this->country,
        ];
    }
}
