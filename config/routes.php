<?php

declare(strict_types=1);

use TeamspeakServerManager\Controller;

return [
    // Static stuff
    ['url' => '/static/{file:.+}', 'methods' => ['GET'], 'controller' => Controller\StaticFileController::class],
    ['url' => '/favicon.ico', 'methods' => ['GET'], 'controller' => Controller\StaticFileController::class],
    ['url' => '/robots.txt', 'methods' => ['GET'], 'controller' => Controller\StaticFileController::class],
    ['url' => '/humans.txt', 'methods' => ['GET'], 'controller' => Controller\StaticFileController::class],

    ['url' => '/', 'methods' => ['GET'], 'controller' => Controller\IndexController::class],
    ['url' => '/history', 'methods' => ['GET'], 'controller' => Controller\HistoryController::class],
    ['url' => '/time', 'methods' => ['GET'], 'controller' => Controller\TimeController::class],
    ['url' => '/info', 'methods' => ['GET'], 'controller' => Controller\InfoController::class],
    ['url' => '/settings', 'methods' => ['GET', 'POST'], 'controller' => Controller\SettingController::class],
];
