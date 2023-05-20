<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

final readonly class IndexController implements ControllerInterface
{
    public function __construct(
        private TeamspeakService $teamspeakService,
    ) {
    }

    public function execute(Request $request): Response
    {
        if ($request->isHxRequest()) {
            return Response::html('htmx/online-clients.phtml', [
                'clients' => $this->teamspeakService->getClients()
            ], 200, true);
        }

        return Response::html('index.phtml', [
            'clients' => $this->teamspeakService->getClients(),
        ]);
    }
}
