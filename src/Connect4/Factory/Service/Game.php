<?php

declare(strict_types=1);

namespace App\Connect4\Factory\Service;

use Interop\Container\ContainerInterface;
use Support\Renderer\Output;
use App\Connect4\Service\Game as ConnectFourInstance; // my own class
use Support\Service\RandomValue;
use Zend\ServiceManager\Factory\FactoryInterface;

final class Game implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): ConnectFourInstance
    {
        return new ConnectFourInstance(
            $container->get(Output::class),
            $container->get(RandomValue::class),
            ...$container->get('participants')
        );
    }
}