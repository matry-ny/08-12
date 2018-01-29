<?php

error_reporting(E_ALL);

$config = require_once __DIR__ . '/configs/main.php';

require_once __DIR__ . '/core/helpers.php';
require_once __DIR__ . '/core/template.php';
require_once __DIR__ . '/core/router.php';

dispatch($_SERVER['REQUEST_URI'], $config['controllersPath'], $config['baseUrl']);
