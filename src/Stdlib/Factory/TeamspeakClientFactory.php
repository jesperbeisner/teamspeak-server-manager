<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib\Factory;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\TeamspeakClient;

final readonly class TeamspeakClientFactory implements FactoryInterface
{
    public function build(Container $container): object
    {
        return new TeamspeakClient($container->get(HttpClientInterface::class));
    }
}
