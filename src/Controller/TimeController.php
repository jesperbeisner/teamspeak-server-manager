<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Interface\ResponseInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response\HtmlResponse;
use TeamspeakServerManager\Table\ClientTimeTable;

final readonly class TimeController implements ControllerInterface
{
    public function __construct(
        private ClientTimeTable $clientTimeTable,
    ) {
    }

    public function execute(Request $request): ResponseInterface
    {
        $times = $this->clientTimeTable->getAll();

        usort($times, fn(array $item1, array $item2) => $item2['time'] <=> $item1['time']);

        if ($request->isHxRequest()) {
            return new HtmlResponse('htmx/time-clients.phtml', ['times' => $times], 200, [], false);
        }

        return new HtmlResponse('time.phtml', ['times' => $times]);
    }
}
