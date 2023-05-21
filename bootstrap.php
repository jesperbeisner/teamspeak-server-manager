<?php

declare(strict_types=1);

use TeamspeakServerManager\Application;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Router;
use TeamspeakServerManager\Table\ClientHistoryTable;
use TeamspeakServerManager\Table\ClientTable;
use TeamspeakServerManager\Table\ClientTimeTable;

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

$container->set(ClientTable::class, new ClientTable());
$container->set(ClientHistoryTable::class, new ClientHistoryTable());
$container->set(ClientTimeTable::class, new ClientTimeTable());

$container->set(Router::class, new Router($config['routes']));

return new Application($container);
