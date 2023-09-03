<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

final readonly class InfoController implements ControllerInterface
{
    public function __construct(
        private TeamspeakService $teamspeakService,
    ) {
    }

    public function execute(Request $request, Response $response): void
    {
        $response->html('info.phtml', ['infos' => $this->teamspeakService->getServerInfo()]);
    }
}
