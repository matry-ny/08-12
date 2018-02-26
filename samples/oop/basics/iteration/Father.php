<?php

class Father extends GrandFather
{
    public $makeSomeShit = true;

    protected $drinkWhiskey = true;

    private $makeSports = false;

    public function iterate()
    {
        parent::iterate();

        var_dump('----------');

        foreach ($this as $key => $value) {
            var_dump($key . ': ' . (int)$value);
        }
    }
}