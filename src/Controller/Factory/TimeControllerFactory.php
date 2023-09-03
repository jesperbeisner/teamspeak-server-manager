<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller\Factory;

use TeamspeakServerManager\Controller\TimeController;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Table\ClientTimeTable;

final readonly class TimeControllerFactory implements FactoryInterface
{
    public function build(Container $container): TimeController
    {
        return new TimeController(
            $container->get(ClientTimeTable::class),
        );
    }
}
