<?php

declare(strict_types=1);

namespace TeamspeakServerManager\DTO;

use TeamspeakServerManager\Interface\ControllerInterface;

final readonly class RouteInfo
{
    /**
     * @param class-string<ControllerInterface> $controller
     * @param array<string, string> $vars
     */
    public function __construct(
        public string $controller,
        public array $vars = [],
    ) {
    }
}
