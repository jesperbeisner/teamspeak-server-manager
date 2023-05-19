<?php

declare(strict_types=1);

use TeamspeakServerManager\Application;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Router;

require __DIR__ . '/vendor/autoload.php';

function e(string $value): string
{
    return htmlspecialchars($value);
}

/** @var array{
 *     routes: array<array{url: string, methods: array<string>, controller: class-string, action: string}>,
 *     services: array<class-string, class-string<FactoryInterface>>
 * } $config */
$config = require __DIR__ . '/config/config.php';

$container = new Container($config['services']);

$router = new Router($config['routes']);
$container->set(Router::class, $router);

return new Application($container);
