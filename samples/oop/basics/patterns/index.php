<?php

require_once __DIR__ . '/Singleton.php';
require_once __DIR__ . '/Registry.php';

$instance = Singleton::getInstance();

Registry::set('test', 123);

var_dump($instance, Registry::get('test'));

