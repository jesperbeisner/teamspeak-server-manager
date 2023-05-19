<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller\Factory;

use TeamspeakServerManager\Controller\ClientsListController;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Container;

final readonly class ClientsListControllerFactory implements FactoryInterface
{
    public function build(Container $container): ClientsListController
    {
        return new ClientsListController($container->get(TeamspeakService::class));
    }
}
