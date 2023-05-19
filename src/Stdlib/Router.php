<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use FastRoute;
use RuntimeException;
use TeamspeakServerManager\Controller\NotFoundController;
use TeamspeakServerManager\DTO\RouteInfo;

final readonly class Router
{
    private FastRoute\Dispatcher $dispatcher;

    /**
     * @param array<array{url: string, methods: array<string>, controller: class-string, action: string}> $routes
     */
    public function __construct(array $routes)
    {
        $this->dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $routeCollector) use ($routes) {
            foreach ($routes as $route) {
                $routeCollector->addRoute($route['methods'], $route['url'], $route['controller']);
            }
        });
    }

    public function route(string $method, string $uri): RouteInfo
    {
        $routeInfo = $this->dispatcher->dispatch($method, $uri);

        if ($routeInfo[0] === FastRoute\Dispatcher::NOT_FOUND) {
            return new RouteInfo(NotFoundController::class);
        }

        if ($routeInfo[0] === FastRoute\Dispatcher::METHOD_NOT_ALLOWED) {
            return new RouteInfo(NotFoundController::class);
        }

        if ($routeInfo[0] === FastRoute\Dispatcher::FOUND) {
            return new RouteInfo($routeInfo[1], $routeInfo[2]);
        }

        throw new RuntimeException('We should never end up down here? Did FastRoute change?');
    }
}
