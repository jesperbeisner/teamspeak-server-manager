<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Manager;

use TeamspeakServerManager\Exception\RuntimeException;
use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Stdlib\Container;

final readonly class ControllerManager
{
    public function __construct(
        private Container $container,
    ) {
    }

    /**
     * @param class-string $controllerClassName
     */
    public function get(string $controllerClassName): ControllerInterface
    {
        $controller = $this->container->get($controllerClassName);

        if (!$controller instanceof ControllerInterface) {
            throw new RuntimeException();
        }

        return $controller;
    }
}
