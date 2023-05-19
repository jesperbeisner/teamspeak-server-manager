<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Service\Factory;

use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\TeamspeakClient;

final readonly class TeamspeakServiceFactory implements FactoryInterface
{
    public function build(Container $container): object
    {
        return new TeamspeakService($container->get(TeamspeakClient::class));
    }
}
