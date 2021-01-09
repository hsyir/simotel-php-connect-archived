<?php

return [
    'smartApi' => [
        'apps' => [
            '*' => "\App\Simotel\SmartApiApps",
        ],
    ],
    'simotelApi' => [
        'user'          => 'username',
        'pass'          => 'password',
        'requestMethod' => 'POST',
        'serverAddress' => 'http://serverAddress',
    ],
];
