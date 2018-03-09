<?php

namespace app;

use app\menu\MenuItem;

/**
 * Class Bar
 * @package app
 */
abstract class Bar implements Gentleman
{
    /**
     * @var MenuItem[]
     */
    protected $menu = [];

    public function addMenuItem(MenuItem $menuItem)
    {
        $this->menu[] = $menuItem;
    }

    abstract public function getMenu();
}
