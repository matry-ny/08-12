<?php

class GrandFather
{
    private $makeSamogon = true;

    protected $sajatKartohu = true;

    public $singASong = false;

    public function iterate()
    {
        foreach ($this as $key => $value) {
            var_dump($key . ': ' . (int)$value);
        }
    }
}