<?php

namespace app;

/**
 * Class Water
 * @package app
 */
class Water
{
    private $composition;

    public function __construct($composition)
    {
        $this->composition = $composition;
    }

    public function get($volume)
    {
        return "{$volume} liters of {$this->composition} water";
    }
}