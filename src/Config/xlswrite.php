<?php

return [
    // 默认驱动
    'driver' => env('XLSWRITE_DRIVER', 'default'),
    // 存储
    'stores' => [
        'default' => [
            'path' => '/',
        ],
    ],
];
