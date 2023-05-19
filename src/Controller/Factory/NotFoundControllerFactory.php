<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller\Factory;

use TeamspeakServerManager\Controller\NotFoundController;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;

final readonly class NotFoundControllerFactory implements FactoryInterface
{
    public function build(Container $container): NotFoundController
    {
        return new NotFoundController();
    }
}
