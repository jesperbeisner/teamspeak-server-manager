<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller\Factory;

use TeamspeakServerManager\Controller\SettingController;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Container;

final readonly class SettingControllerFactory implements FactoryInterface
{
    public function build(Container $container): SettingController
    {
        return new SettingController(
            $container->get(TeamspeakService::class),
        );
    }
}
