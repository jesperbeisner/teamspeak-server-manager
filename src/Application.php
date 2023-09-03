<?php

declare(strict_types=1);

namespace TeamspeakServerManager;

use TeamspeakServerManager\Interface\TimerInterface;
use TeamspeakServerManager\Stdlib\Config;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

final readonly class Application
{
    public function __construct(
        private Container $container,
    ) {
    }

    public function run(Request $request, Response $response): Response
    {
        foreach ($this->container->get(Config::class)->getMiddlewares() as $middleware) {
            $this->container->get($middleware)->handle($request, $response);

            if ($request->isPropagationStopped()) {
                break;
            }
        }

        return $response;
    }

    /**
     * @param class-string<TimerInterface> $timerName
     */
    public function timer(string $timerName): TimerInterface
    {
        return $this->container->get($timerName);
    }
}
