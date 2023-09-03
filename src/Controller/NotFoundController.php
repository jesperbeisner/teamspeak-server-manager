<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

final readonly class NotFoundController implements ControllerInterface
{
    public function execute(Request $request, Response $response): void
    {
        $response->html('error/not-found.phtml', [], 404);
    }
}
