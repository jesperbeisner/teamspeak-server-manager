<?php

declare(strict_types=1);

use TeamspeakServerManager\Application;
use TeamspeakServerManager\Stdlib\Config;
use TeamspeakServerManager\Stdlib\Container;
use TeamspeakServerManager\Stdlib\Router;
use TeamspeakServerManager\Table\ClientHistoryTable;
use TeamspeakServerManager\Table\ClientOnlineTable;
use TeamspeakServerManager\Table\ClientTimeTable;

require __DIR__ . '/vendor/autoload.php';

$config = new Config(__DIR__ . '/config');

$container = new Container($config->getServices());

$container->set(Router::class, new Router($config->getRoutes()));

$container->set(ClientOnlineTable::class, new ClientOnlineTable());
$container->set(ClientHistoryTable::class, new ClientHistoryTable());
$container->set(ClientTimeTable::class, new ClientTimeTable());

return new Application($container);
