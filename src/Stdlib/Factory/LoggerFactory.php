<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib\Factory;

use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Config;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Logger;

final readonly class LoggerFactory implements FactoryInterface
{
    public function build(Container $container): Logger
    {
        return new Logger($container->get(Config::class)->getBasePath() . '/var/app.log');
    }
}
