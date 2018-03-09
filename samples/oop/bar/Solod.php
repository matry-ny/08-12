<?php

namespace app;

/**
 * Class Solod
 * @package app
 */
class Solod
{
    private $type;

    private $isFried = false;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function get($weight)
    {
        $fried = $this->isFried ? 'fried ' : '';
        return "{$weight} kg of {$fried}{$this->type} solod";
    }

    public function fry()
    {
        $this->isFried = true;
        return $this;
    }
}