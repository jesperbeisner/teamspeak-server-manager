<?php

declare(strict_types=1);

use TeamspeakServerManager\Application;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Router;
use TeamspeakServerManager\Table\ClientHistoryTable;
use TeamspeakServerManager\Table\ClientOnlineTable;
use TeamspeakServerManager\Table\ClientTimeTable;

require __DIR__ . '/vendor/autoload.php';

/** @var array{
 *     routes: array<array{url: string, methods: array<string>, controller: class-string, action: string}>,
 *     services: array<class-string, class-string<FactoryInterface>>
 * } $config
 */
$config = require __DIR__ . '/config/config.php';

$container = new Container($config['services']);

$container->set(ClientOnlineTable::class, new ClientOnlineTable());
$container->set(ClientHistoryTable::class, new ClientHistoryTable());
$container->set(ClientTimeTable::class, new ClientTimeTable());

$container->set(Router::class, new Router($config['routes']));

return new Application($container);
