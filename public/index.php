<?php

declare(strict_types=1);

use Swoole\Http\Server as SwooleServer;
use Swoole\Http\Request as SwooleRequest;
use Swoole\Http\Response as SwooleResponse;
use Swoole\Timer as SwooleTimer;
use TeamspeakServerManager\Application;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;
use TeamspeakServerManager\Timer\ClientTimer;

/** @var Application $application */
$application = require __DIR__ . '/../bootstrap.php';

$swooleServer = new SwooleServer('0.0.0.0', 9501);

$swooleServer->on('Start', function (): void {
    echo 'Swoole http server is started at http://127.0.0.1:9501' . PHP_EOL;
});

$swooleServer->on('Request', function (SwooleRequest $swooleRequest, SwooleResponse $swooleResponse) use ($application): void {
    $application->run(Request::fromSwooleRequest($swooleRequest), new Response())->send($swooleResponse);
});

SwooleTimer::tick(1000, function() use ($application): void {
    $application->timer(ClientTimer::class)->start();
});

$swooleServer->start();
