<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Manager\Factory;

use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Manager\ControllerManager;
use TeamspeakServerManager\Stdlib\Container;

final readonly class ControllerManagerFactory implements FactoryInterface
{
    public function build(Container $container): ControllerManager
    {
        return new ControllerManager(
            $container,
        );
    }
}
