<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Middleware\Factory;

use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Middleware\RequestUuidMiddleware;
use TeamspeakServerManager\Stdlib\Container;

final readonly class RequestUuidMiddlewareFactory implements FactoryInterface
{
    public function build(Container $container): RequestUuidMiddleware
    {
        return new RequestUuidMiddleware();
    }
}
