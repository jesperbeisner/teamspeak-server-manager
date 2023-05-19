<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller\Factory;

use TeamspeakServerManager\Controller\IndexController;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Container;

final readonly class IndexControllerFactory implements FactoryInterface
{
    public function build(Container $container): IndexController
    {
        return new IndexController($container->get(TeamspeakService::class));
    }
}
