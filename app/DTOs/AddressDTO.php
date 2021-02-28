<?php

namespace App\DTOs;

class AddressDTO extends AbstractDTO
{
    public string $street;
    public string $city;
    public string $region;
    public string $country;
    public string $postal_code;
    public float $latitude;
    public float $longitude;
}
