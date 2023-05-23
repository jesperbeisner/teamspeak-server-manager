<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Timer\Factory;

use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Table\ClientHistoryTable;
use TeamspeakServerManager\Table\ClientOnlineTable;
use TeamspeakServerManager\Table\ClientTimeTable;
use TeamspeakServerManager\Timer\ClientTimer;

final readonly class ClientTimerFactory implements FactoryInterface
{
    public function build(Container $container): ClientTimer
    {
        return new ClientTimer(
            $container->get(ClientOnlineTable::class),
            $container->get(ClientHistoryTable::class),
            $container->get(ClientTimeTable::class),
            $container->get(TeamspeakService::class),
        );
    }
}
