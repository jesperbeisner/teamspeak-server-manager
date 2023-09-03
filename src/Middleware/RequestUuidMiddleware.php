<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Middleware;

use TeamspeakServerManager\Helper\Uuid;
use TeamspeakServerManager\Interface\MiddlewareInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

final readonly class RequestUuidMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Response $response): void
    {
        $response->setHeader('X-REQUEST-ID', Uuid::v4());
    }
}
