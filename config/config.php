<?php

$config = [
    'twig.resource.path'        => __DIR__ . '/../src/Board/Resources/Templates',
    'twig.compilation.cache'    => __DIR__ . '/../cache/twig',
    'template.engine'           => 'twig',

    'database' => [
        'type'     => 'mysql',
        'host'     => 'localhost',
        'port'     => '3306',
        'name'     => 'senshu',
        'user'     => 'root',
        'password' => 'pass'
    ]
];
