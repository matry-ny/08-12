<?php

abstract class Bar implements Gentleman
{
    /**
     * @var menu_MenuItem[]
     */
    protected $menu = [];

    public function addMenuItem(menu_MenuItem $menuItem)
    {
        $this->menu[] = $menuItem;
    }

    abstract public function getMenu();
}
