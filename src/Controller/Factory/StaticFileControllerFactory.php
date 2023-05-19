<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller\Factory;

use TeamspeakServerManager\Controller\StaticFileController;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;

final readonly class StaticFileControllerFactory implements FactoryInterface
{
    public function build(Container $container): StaticFileController
    {
        return new StaticFileController();
    }
}
