<?php

class Bar
{
    private $name;

    private $hasCocktails = false;

    public function getName()
    {
        return $this->name;
    }

    protected function setName($name)
    {
        $this->name = $name;
    }

    public function getMenu()
    {
        return 'Menu of some foods';
    }

    public function allowCocktails()
    {
        $this->hasCocktails = true;
    }

    public function __destruct()
    {
        echo static::class . '[' . spl_object_hash($this) . '] is destroyed<br>';
    }
}
