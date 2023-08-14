<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib\Factory;

use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Config;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Renderer;

final readonly class RendererFactory implements FactoryInterface
{
    public function build(Container $container): Renderer
    {
        return new Renderer($container->get(Config::class)->getBasePath() . '/views');
    }
}
