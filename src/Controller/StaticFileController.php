<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use RuntimeException;
use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

final readonly class StaticFileController implements ControllerInterface
{
    public function execute(Request $request): Response
    {
        if ($request->getUri() === '/css/pico.css') {
            return Response::css(file_get_contents(__DIR__ . '/../../public/css/pico.css'));
        }

        if ($request->getUri() === '/css/style.css') {
            return Response::css(file_get_contents(__DIR__ . '/../../public/css/style.css'));
        }

        if ($request->getUri() === '/js/htmx.js') {
            return Response::js(file_get_contents(__DIR__ . '/../../public/js/htmx.js'));
        }

        if ($request->getUri() === '/favicon.ico') {
            return Response::favicon(file_get_contents(__DIR__ . '/../../public/favicon.ico'));
        }

        if ($request->getUri() === '/robots.txt') {
            return Response::text(file_get_contents(__DIR__ . '/../../public/robots.txt'));
        }

        if ($request->getUri() === '/humans.txt') {
            return Response::text(file_get_contents(__DIR__ . '/../../public/humans.txt'));
        }

        throw new RuntimeException('Reaching this Exception should not be possible?');
    }
}
