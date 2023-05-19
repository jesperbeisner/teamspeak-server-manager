<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller\Factory;

use TeamspeakServerManager\Controller\NotAllowedController;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;

final readonly class NotAllowedControllerFactory implements FactoryInterface
{
    public function build(Container $container): NotAllowedController
    {
        return new NotAllowedController();
    }
}
