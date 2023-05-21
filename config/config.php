<?php

declare(strict_types=1);

use Symfony\Contracts\HttpClient\HttpClientInterface;
use TeamspeakServerManager\Controller;
use TeamspeakServerManager\Service;
use TeamspeakServerManager\Stdlib;
use TeamspeakServerManager\Timer;

return [
    'routes' => [
        ['url' => '/', 'methods' => ['GET'], 'controller' => Controller\IndexController::class],
        ['url' => '/history', 'methods' => ['GET', 'POST'], 'controller' => Controller\HistoryController::class],

        // Static stuff
        ['url' => '/css/pico.css', 'methods' => ['GET'], 'controller' => Controller\StaticFileController::class],
        ['url' => '/css/style.css', 'methods' => ['GET'], 'controller' => Controller\StaticFileController::class],
        ['url' => '/js/htmx.js', 'methods' => ['GET'], 'controller' => Controller\StaticFileController::class],
        ['url' => '/favicon.ico', 'methods' => ['GET'], 'controller' => Controller\StaticFileController::class],
        ['url' => '/robots.txt', 'methods' => ['GET'], 'controller' => Controller\StaticFileController::class],
        ['url' => '/humans.txt', 'methods' => ['GET'], 'controller' => Controller\StaticFileController::class],
    ],
    'services' => [
        // Controller
        Controller\IndexController::class => Controller\Factory\IndexControllerFactory::class,
        Controller\HistoryController::class => Controller\Factory\HistoryControllerFactory::class,

        Controller\StaticFileController::class => Controller\Factory\StaticFileControllerFactory::class,
        Controller\NotFoundController::class => Controller\Factory\NotFoundControllerFactory::class,
        Controller\NotAllowedController::class => Controller\Factory\NotAllowedControllerFactory::class,

        // Random
        HttpClientInterface::class => Stdlib\Factory\HttpClientFactory::class,

        // Service
        Service\TeamspeakService::class => Service\Factory\TeamspeakServiceFactory::class,

        // Stdlib
        Stdlib\TeamspeakClient::class => Stdlib\Factory\TeamspeakClientFactory::class,

        // Timer
        Timer\ClientTimer::class => Timer\Factory\ClientTimerFactory::class,
    ],
];
