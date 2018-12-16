<?php

declare(strict_types=1);

use Support\Factory;
use Support\Renderer;
use Support\Service;
use Zend\ServiceManager\Factory\InvokableFactory;


use Src\Factory as SrcFactory; // use my ow Factory
use Src\Service as SrcService; // use my own ConnectFourGame service


return [
    'games' => [
        'connect4' => SrcService\ConnectFourGame::class, // my own service
    ],
    'service_manager' => [
        'factories' => [
            Renderer\Output::class => Factory\Renderer\Output::class,
            SrcService\ConnectFourGame::class => SrcFactory\Service\ConnectFourGame::class,
            // InvokableFactory can be used when the service does not need any constructor argument
            Service\PseudoRandomValue::class => InvokableFactory::class,
        ],
        'aliases' => [
            Service\RandomValue::class => Service\PseudoRandomValue::class,
        ],
    ]
];