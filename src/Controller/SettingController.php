<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

final readonly class SettingController implements ControllerInterface
{
    public function __construct(
        private TeamspeakService $teamspeakService,
    ) {
    }

    public function execute(Request $request, Response $response): void
    {
        if ($request->isHxRequest() && $request->isPost()) {
            $this->teamspeakService->resetChannels();

            $response->html('htmx/reset-channels.phtml', [], 200, false);

            return;
        }

        $response->html('settings.phtml');
    }
}
