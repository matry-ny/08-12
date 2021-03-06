<?php

namespace app\menu;

/**
 * Class MenuItem
 * @package app\menu
 */
abstract class MenuItem
{
    private $title;
    private $weight;
    private $price;

    public function __construct($title, $weight, $price)
    {
        $this->title = $title;
        $this->weight = $weight;
        $this->price = $price;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getPrice()
    {
        return $this->price;
    }
}