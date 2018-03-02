<?php

class Hmel
{
    private $country;

    public function __construct($country)
    {
        $this->country = $country;
    }

    public function get($weight)
    {
        return "{$weight} kg of {$this->country} hmel";
    }
}