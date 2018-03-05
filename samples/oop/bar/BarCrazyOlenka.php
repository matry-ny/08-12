<?php

class BarCrazyOlenka extends BarOlenka
{
    public function getPepelnitsa()
    {
        return static::class . ' >> Lux';
    }
}