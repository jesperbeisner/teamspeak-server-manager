<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Interface;

use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

interface MiddlewareInterface
{
    public function handle(Request $request, Response $response): void;
}
