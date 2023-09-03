<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller\Factory;

use TeamspeakServerManager\Controller\HistoryController;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Table\ClientHistoryTable;

final readonly class HistoryControllerFactory implements FactoryInterface
{
    public function build(Container $container): HistoryController
    {
        return new HistoryController(
            $container->get(ClientHistoryTable::class),
        );
    }
}
