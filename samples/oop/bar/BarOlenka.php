<?php

class BarOlenka extends Bar implements Smoky, Gentleman
{
    public function getMenu()
    {
        $menu = [];
        foreach ($this->menu as $item) {
            $menu[] = "{$item->getTitle()} ({$item->getWeight()}): {$item->getPrice()} UAH";
        }

        $delimiter = strtolower(php_sapi_name()) === 'cli' ? PHP_EOL : '<br>';
        return implode($delimiter, $menu) . $delimiter;
    }

    final public function callGirl()
    {
        return 'Girls is comming';
    }

    final public function buyCigarettes()
    {
        return 'Olenka Cigarettes';
    }

    public function getPepelnitsa()
    {
        return static::class;
    }
}
