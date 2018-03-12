<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = require_once __DIR__ . '/configs/main.php';
\app\common\Application::init($config);
