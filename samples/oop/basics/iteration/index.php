<?php

require_once __DIR__ . '/GrandFather.php';
require_once __DIR__ . '/Father.php';
require_once __DIR__ . '/Son.php';

$grandFather = new GrandFather();
$father = new Father();
$son = new Son();

$father->iterate();
