<?php

declare(strict_types=1);

use TeamspeakServerManager\Application;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Router;
use TeamspeakServerManager\Table\ClientTable;

require __DIR__ . '/vendor/autoload.php';

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8');
}

/** @var array{
 *     routes: array<array{url: string, methods: array<string>, controller: class-string, action: string}>,
 *     services: array<class-string, class-string<FactoryInterface>>
 * } $config
 */
$config = require __DIR__ . '/config/config.php';

$container = new Container($config['services']);

$clientTable = new ClientTable();
$container->set(ClientTable::class, $clientTable);

$router = new Router($config['routes']);
$container->set(Router::class, $router);

return new Application($container);
