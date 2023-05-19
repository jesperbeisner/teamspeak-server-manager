<?php

declare(strict_types=1);

namespace TeamspeakServerManager\DTO;

final readonly class RouteInfo
{
    public function __construct(
        public string $controller,
        public array $vars = [],
    ) {
    }
}
