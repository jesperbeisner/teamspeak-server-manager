<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Interface\ResponseInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response\HtmlResponse;

final readonly class NotFoundController implements ControllerInterface
{
    public function execute(Request $request): ResponseInterface
    {
        return new HtmlResponse('error/not-found.phtml', [], 404);
    }
}
