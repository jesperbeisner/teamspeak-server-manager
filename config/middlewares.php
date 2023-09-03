<?php

declare(strict_types=1);

use TeamspeakServerManager\Middleware;

return [
    Middleware\RequestUuidMiddleware::class,
    Middleware\RouterMiddleware::class,
    Middleware\ControllerMiddleware::class,
    Middleware\RenderMiddleware::class,
];
