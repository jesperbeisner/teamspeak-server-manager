<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;
use TeamspeakServerManager\Table\ClientTimeTable;

final readonly class TimeController implements ControllerInterface
{
    public function __construct(
        private ClientTimeTable $clientTimeTable,
    ) {
    }

    public function execute(Request $request, Response $response): void
    {
        $times = $this->clientTimeTable->getAll();

        usort($times, fn(array $item1, array $item2) => $item2['time'] <=> $item1['time']);

        if ($request->isHxRequest()) {
            $response->html('htmx/time-clients.phtml', ['times' => $times], 200, false);

            return;
        }

        $response->html('time.phtml', ['times' => $times]);
    }
}
