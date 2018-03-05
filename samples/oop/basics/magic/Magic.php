<?php

class Magic
{
    public $test;

    private $storage = [];

    public function __set($key, $value)
    {
        $this->storage[$key] = $value;
    }

    public function __get($key)
    {
        return isset($this->{$key}) ? $this->storage[$key] : null;
    }

    public function __call($name, $arguments)
    {
        $property = substr($name, 3);
        if (isset($this->{$property})) {
            return $this->storage[$property];
        }

        return null;
    }

    public function __isset($name)
    {
        return array_key_exists($name, $this->storage);
    }

    public function __sleep()
    {
        return ['storage'];
    }

    public function __wakeup()
    {
        var_dump('I am alive');
    }

    public function __invoke()
    {
        return 123;
    }

    public function __toString()
    {
        return 'My magic object';
    }

//    public function __debugInfo()
//    {
//        return ['storage' => ['ne dlay tebe kvitichka rosla']];
//    }
}