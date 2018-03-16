<?php

return [
    'controllers' => [
        'namespace' => 'app\console\controllers',
        'default' => 'index'
    ],
    'actions' => [
        'default' => 'index'
    ],
    'migrations' => [
        'dir' => __DIR__ . '/../migrations',
        'namespace' => 'app\console\migrations',
        'table' => 'migrations'
    ]
];
