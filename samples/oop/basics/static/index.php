<?php

require_once __DIR__ . '/Strings.php';

Strings::$string = 'Test string';

var_dump(Strings::toUpperCase('Test string'));
