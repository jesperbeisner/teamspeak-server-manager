<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Interface\ResponseInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response\StaticResponse;

final readonly class StaticFileController implements ControllerInterface
{
    public function execute(Request $request): ResponseInterface
    {
        if (in_array($request->getUri(), ['/favicon.ico', '/robots.txt', '/humans.txt'], true)) {
            return new StaticResponse(sprintf(__DIR__ . '/../../public/%s', $request->getUri()), ['Cache-Control' => 'max-age: 31536000']);
        }

        return new StaticResponse(sprintf(__DIR__ . '/../../public/static/%s', $request->getRouteVars()['file']), ['Cache-Control' => 'max-age: 2592000']);
    }
}
