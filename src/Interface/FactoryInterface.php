<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Interface;

use TeamspeakServerManager\Stdlib\Container;

interface FactoryInterface
{
    public function build(Container $container): object;
}
