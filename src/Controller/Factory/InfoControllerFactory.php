<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller\Factory;

use TeamspeakServerManager\Controller\InfoController;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Container;

final readonly class InfoControllerFactory implements FactoryInterface
{
    public function build(Container $container): InfoController
    {
        return new InfoController(
            $container->get(TeamspeakService::class),
        );
    }
}
