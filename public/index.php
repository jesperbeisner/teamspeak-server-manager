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
    echo 'OpenSwoole http server is started at http://127.0.0.1:9501' . PHP_EOL;
});

$swooleServer->on('Request', function (SwooleRequest $swooleRequest, SwooleResponse $swooleResponse) use ($application): void {
    try {
        $application->run(Request::fromSwooleRequest($swooleRequest))->send($swooleResponse);
    } catch (Throwable $e) {
        // TODO: Log Exception
        echo $e->getMessage() . PHP_EOL;

        Response::html('error/server.phtml', [], 500)->send($swooleResponse);
    }
});

SwooleTimer::tick(2500, function() use ($application): void {
    try {
        $application->timer(ClientTimer::class)->run();
    } catch (Throwable $e) {
        // TODO: Log Exception
        echo $e->getMessage() . PHP_EOL;
    }
});

$swooleServer->start();
