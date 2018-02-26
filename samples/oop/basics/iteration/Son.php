<?php

class Son extends Father
{
    public $goToSchool = true;
    protected $smoke = true;
    private $writePHP = true;

    public function iterate()
    {
        foreach ($this as $key => $value) {
            var_dump($key . ': ' . (int)$value);
        }
    }
}