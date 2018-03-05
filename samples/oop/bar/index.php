<?php

require_once __DIR__ . '/autoload.php';

$bar = new BarOlenka();

$obolonBeer = new menu_Beer('Obolon', 0.5, 20);
$bar->addMenuItem($obolonBeer);

$kosichkaChese = new menu_Cheese('Kosichka', 200, 50.98);
$bar->addMenuItem($kosichkaChese);

echo $bar->getMenu();
var_dump($bar->callGirl());
var_dump($bar->getPepelnitsa());

$crazyBar = new BarCrazyOlenka();
var_dump($crazyBar->callGirl());
var_dump($crazyBar->getPepelnitsa());

