<?php

declare(strict_types=1);

use Support\Factory;
use Support\Renderer;
use Support\Service;
use Zend\ServiceManager\Factory\InvokableFactory;


use App\Connect4\Factory\Service\Game as Connect4Factory; // use my ow Factory
use App\Connect4\Service\Game as Connect4; // use my own ConnectFourGame service


return [
    'games' => [
        'connect4' => Connect4::class, // my own service
    ],
    'service_manager' => [
        'factories' => [
            Renderer\Output::class => Factory\Renderer\Output::class,
            Connect4::class => Connect4Factory::class,
            // InvokableFactory can be used when the service does not need any constructor argument
            Service\PseudoRandomValue::class => InvokableFactory::class,
        ],
        'aliases' => [
            Service\RandomValue::class => Service\PseudoRandomValue::class,
        ],
    ]
];