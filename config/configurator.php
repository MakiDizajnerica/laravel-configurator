<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Configurator Driver
    |--------------------------------------------------------------------------
    |
    | Define default driver that will be used for storing custom config values.
    |
    | Supported: "database", "file", "cache"
    |
    */

    'default' => env('CONFIGURATOR_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Configurator Drivers
    |--------------------------------------------------------------------------
    */

    'drivers' => [

        'database' => [
            'driver' => \MakiDizajnerica\Configurator\Drivers\Database::class,
            // config
        ],

        'file' => [
            'driver' => \MakiDizajnerica\Configurator\Drivers\File::class,
            // config
        ],

        'cache' => [
            'driver' => \MakiDizajnerica\Configurator\Drivers\Cache::class,
            // config
        ],

    ],

];
