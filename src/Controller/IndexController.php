<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Interface\ResponseInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response\HtmlResponse;

final readonly class IndexController implements ControllerInterface
{
    public function __construct(
        private TeamspeakService $teamspeakService,
    ) {
    }

    public function execute(Request $request): ResponseInterface
    {
        if ($request->isHxRequest()) {
            return new HtmlResponse('htmx/online-clients.phtml', ['clients' => $this->teamspeakService->getClients()], 200, [], false);
        }

        return new HtmlResponse('index.phtml', ['clients' => $this->teamspeakService->getClients()]);
    }
}
