<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Controller;

use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Interface\ResponseInterface;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response\HtmlResponse;
use TeamspeakServerManager\Table\ClientHistoryTable;

readonly class HistoryController implements ControllerInterface
{
    public function __construct(
        private ClientHistoryTable $clientHistoryTable,
    ) {
    }

    public function execute(Request $request): ResponseInterface
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

            return new HtmlResponse('htmx/history-clients.phtml', [
                'histories' => $histories,
                'search' => $search,
            ], 200, [], false);
        }

        return new HtmlResponse('history.phtml', [
            'histories' => $this->clientHistoryTable->getAll(),
            'search' => null,
        ]);
    }
}
