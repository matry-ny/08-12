<?php

namespace app;

/**
 * Trait CleaningManager
 * @package app
 */
trait CleaningManager
{
    /**
     * @return string
     */
    public function getName(): string
    {
        $rand = mt_rand();
        return "Cleaning manager #{$rand}<br>";
    }
}