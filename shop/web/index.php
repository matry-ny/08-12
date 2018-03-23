<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = array_merge(
    require_once __DIR__ . '/../common/configs/main.php',
    require_once __DIR__ . '/configs/main.php'
);
\app\common\Application::init($config);
