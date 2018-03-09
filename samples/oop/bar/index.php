<?php

require_once __DIR__ . '/lib/ClassLoader.php';
$loader = new \app\lib\ClassLoader(__DIR__, 'app');

spl_autoload_register([$loader, 'load']);

use App\{BarOlenka, BarCrazyOlenka};
use app\menu\{Cheese, Beer};
use app\foods\Cheese as CheeseFood;

new CheeseFood();

$bar = new BarOlenka();

var_dump($bar->isAdult(mt_rand(5, 100)));

$obolonBeer = new Beer('Obolon', 0.5, 20);
$bar->addMenuItem($obolonBeer);

$kosichkaChese = new Cheese('Kosichka', 200, 50.98);
$bar->addMenuItem($kosichkaChese);

echo $bar->getMenu();
var_dump($bar->callGirl());
var_dump($bar->getPepelnitsa());

$crazyBar = new BarCrazyOlenka();
var_dump($crazyBar->callGirl());
var_dump($crazyBar->getPepelnitsa());

