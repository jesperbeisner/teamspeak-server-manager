<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;
use TeamspeakServerManager\Table\ClientHistoryTable;

final readonly class HistoryController implements ControllerInterface
{
    public function __construct(
        private ClientHistoryTable $clientHistoryTable,
    ) {
    }

    public function execute(Request $request): Response
    {
        if ($request->isHxRequest()) {
            $histories = $this->clientHistoryTable->getAll();
            $search = $request->getGet('search');

            if ($search === '') {
                $search = null;
            }

            if ($search !== null) {
                foreach ($histories as $key => $history) {
                    if (!str_contains(strtolower($history['uuid']), strtolower($search)) && !str_contains(strtolower($history['nickname']), strtolower($search))) {
                        unset($histories[$key]);
                    }
                }
            }

            return Response::html('htmx/history-clients.phtml', ['histories' => $histories, 'search' => $search], 200, true);
        }

        return Response::html('history.phtml', ['histories' => $this->clientHistoryTable->getAll(), 'search' => null]);
    }
}
