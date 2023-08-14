<?php

declare(strict_types=1);

use Symfony\Contracts\HttpClient\HttpClientInterface;
use TeamspeakServerManager\Controller;
use TeamspeakServerManager\Service;
use TeamspeakServerManager\Stdlib;
use TeamspeakServerManager\Timer;

return [
    // Controller
    Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
    Controller\HistoryController::class => Controller\Factory\HistoryControllerFactory::class,
    Controller\TimeController::class => Controller\Factory\TimeControllerFactory::class,
    Controller\InfoController::class => Controller\Factory\InfoControllerFactory::class,
    Controller\SettingController::class => Controller\Factory\SettingControllerFactory::class,

    Controller\StaticFileController::class => Controller\Factory\StaticFileControllerFactory::class,
    Controller\NotFoundController::class => Controller\Factory\NotFoundControllerFactory::class,
    Controller\NotAllowedController::class => Controller\Factory\NotAllowedControllerFactory::class,

    // Random
    HttpClientInterface::class => Stdlib\Factory\HttpClientFactory::class,

    // Service
    Service\TeamspeakService::class => Service\Factory\TeamspeakServiceFactory::class,

    // Stdlib
    Stdlib\TeamspeakClient::class => Stdlib\Factory\TeamspeakClientFactory::class,
    Stdlib\Logger::class => Stdlib\Factory\LoggerFactory::class,
    Stdlib\Renderer::class => Stdlib\Factory\RendererFactory::class,

    // Timer
    Timer\ClientTimer::class => Timer\Factory\ClientTimerFactory::class,
];
