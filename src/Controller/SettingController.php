<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Interface\ResponseInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response\HtmlResponse;

final readonly class SettingController implements ControllerInterface
{
    public function __construct(
        private TeamspeakService $teamspeakService,
    ) {
    }

    public function execute(Request $request): ResponseInterface
    {
        if ($request->isHxRequest() && $request->isPost()) {
            $this->teamspeakService->resetChannels();

            return new HtmlResponse('htmx/reset-channels.phtml', [], 200, [], false);
        }

        return new HtmlResponse('settings.phtml');
    }
}
