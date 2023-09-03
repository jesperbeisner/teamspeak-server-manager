<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Middleware;

use TeamspeakServerManager\Interface\MiddlewareInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;
use TeamspeakServerManager\Stdlib\Router;

final readonly class RouterMiddleware implements MiddlewareInterface
{
    public function __construct(
        private Router $router,
    ) {
    }

    public function handle(Request $request, Response $response): void
    {
        $request->setRouteInfo($this->router->route($request->getMethod(), $request->getUri()));
    }
}
