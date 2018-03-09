<?php

namespace app;

/**
 * Class BarCrazyOlenka
 * @package app
 */
class BarCrazyOlenka extends BarOlenka
{
    public function getPepelnitsa()
    {
        return static::class . ' >> Lux';
    }
}