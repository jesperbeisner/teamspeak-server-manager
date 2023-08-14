<?php

declare(strict_types=1);

namespace TeamspeakServerManager;

use TeamspeakServerManager\Exception\ThisShouldNeverHappenException;
use TeamspeakServerManager\Interface\ResponseInterface;
use TeamspeakServerManager\Interface\TimerInterface;
use TeamspeakServerManager\Stdlib\Config;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Renderer;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response\HtmlResponse;
use TeamspeakServerManager\Stdlib\Router;
use Throwable;

final readonly class Application
{
    public function __construct(
        private Container $container,
    ) {
    }

    public function run(Request $request): ResponseInterface
    {
        try {
            $router = $this->container->get(Router::class);
            $routeInfo = $router->route($request->getMethod(), $request->getUri());

            $request->setRouteInfo($routeInfo);

            $controller = $this->container->get($routeInfo->controller);

            $response = $controller->execute($request);

            if ($response instanceof HtmlResponse) {
                $response->setRenderer($this->container->get(Renderer::class));
            }

            return $response;
        } catch (Throwable $e) {
            $response = new HtmlResponse('error/server.phtml', ['exception' => $e, 'appEnv' => $this->container->get(Config::class)->getAppEnv()], 500);
            $response->setRenderer($this->container->get(Renderer::class));

            return $response;
        }
    }

    /**
     * @param class-string<TimerInterface> $timerName
     */
    public function timer(string $timerName): TimerInterface
    {
        return $this->container->get($timerName);
    }
}
