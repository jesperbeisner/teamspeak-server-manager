<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Middleware\Factory;

use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Manager\ControllerManager;
use TeamspeakServerManager\Middleware\ControllerMiddleware;
use TeamspeakServerManager\Stdlib\Container;

final readonly class ControllerMiddlewareFactory implements FactoryInterface
{
    public function build(Container $container): ControllerMiddleware
    {
        return new ControllerMiddleware(
            $container->get(ControllerManager::class),
        );
    }
}
