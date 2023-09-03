<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Middleware\Factory;

use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Middleware\RouterMiddleware;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Router;

final readonly class RouterMiddlewareFactory implements FactoryInterface
{
    public function build(Container $container): RouterMiddleware
    {
        return new RouterMiddleware(
            $container->get(Router::class),
        );
    }
}
