<?php

namespace App;

/**
 * Class BarOlenka
 * @package app
 */
class BarOlenka extends Bar implements Smoky, Gentleman
{
    use FaceControl, CleaningManager {
        CleaningManager::getName insteadof FaceControl;
        FaceControl::getName as faceControlName;
    }

    public function __construct()
    {
        echo $this->getName(), $this->faceControlName();
    }

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
