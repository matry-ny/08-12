<?php

/**
 * Class Singleton
 */
class Singleton
{
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @var null|Singleton
     */
    private static $instance = null;

    /**
     * @return Singleton
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
