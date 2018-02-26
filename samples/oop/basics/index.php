<?php

require_once __DIR__ . '/Bar.php';
require_once __DIR__ . '/SmokyBar.php';

$bar = new SmokyBar('Par Bar');
$bar2 = new Bar();

unset($bar);
