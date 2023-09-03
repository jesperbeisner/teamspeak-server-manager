<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Middleware;

use TeamspeakServerManager\Interface\MiddlewareInterface;
use TeamspeakServerManager\Manager\ControllerManager;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

final readonly class ControllerMiddleware implements MiddlewareInterface
{
    public function __construct(
        private ControllerManager $controllerManager,
    ) {
    }

    public function handle(Request $request, Response $response): void
    {
        $this->controllerManager->get($request->getController())->execute($request, $response);
    }
}
