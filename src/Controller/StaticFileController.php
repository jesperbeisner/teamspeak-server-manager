<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

final readonly class StaticFileController implements ControllerInterface
{
    public function execute(Request $request, Response $response): void
    {
        if (in_array($request->getUri(), ['/favicon.ico', '/robots.txt', '/humans.txt'], true)) {
            $response->file(sprintf(__DIR__ . '/../../public/%s', $request->getUri()));
            $response->setHeader('Cache-Control', 'max-age: 31536000');

            return;
        }

        $response->file(sprintf(__DIR__ . '/../../public/static/%s', $request->getRouteVars()['file']));
        $response->setHeader('Cache-Control', 'max-age: 2592000');
    }
}
