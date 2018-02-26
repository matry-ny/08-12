<?php

class SmokyBar extends Bar
{
    public function __construct($name)
    {
        $this->setName($name);
    }

    public function getHookah()
    {
        return 'Some Hookah';
    }

    public function getMenu()
    {
        return parent::getMenu() . ' and some hookahs';
    }
}