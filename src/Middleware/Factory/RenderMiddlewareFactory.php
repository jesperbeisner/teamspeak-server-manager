<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Middleware\Factory;

use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Middleware\RenderMiddleware;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Renderer;

final readonly class RenderMiddlewareFactory implements FactoryInterface
{
    public function build(Container $container): RenderMiddleware
    {
        return new RenderMiddleware(
            $container->get(Renderer::class),
        );
    }
}
