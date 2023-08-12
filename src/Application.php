<?php

declare(strict_types=1);

namespace TeamspeakServerManager;

use TeamspeakServerManager\Exception\ThisShouldNeverHappenException;
use TeamspeakServerManager\Interface\ResponseInterface;
use TeamspeakServerManager\Interface\TimerInterface;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Router;

final readonly class Application
{
    public function __construct(
        private Container $container,
    ) {
    }

    public function run(Request $request): ResponseInterface
    {
        $router = $this->container->get(Router::class);
        $routeInfo = $router->route($request->getMethod(), $request->getUri());

        $request->setRouteInfo($routeInfo);

        $controller = $this->container->get($routeInfo->controller);

        return $controller->execute($request);
    }

    /**
     * @param class-string<TimerInterface> $timerName
     */
    public function timer(string $timerName): TimerInterface
    {
        return $this->container->get($timerName);
    }
}
