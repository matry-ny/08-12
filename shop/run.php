<?php

require_once __DIR__ . '/vendor/autoload.php';

$config = array_merge(
    require_once __DIR__ . '/common/configs/main.php',
    require_once __DIR__ . '/console/configs/main.php'
);
echo \app\common\Application::init($config);
