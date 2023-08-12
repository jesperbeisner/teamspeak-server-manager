<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Timer;

use TeamspeakServerManager\Enum\StatusEnum;
use TeamspeakServerManager\Interface\TimerInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Table\ClientHistoryTable;
use TeamspeakServerManager\Table\ClientOnlineTable;
use TeamspeakServerManager\Table\ClientTimeTable;
use Throwable;

final readonly class ClientTimer implements TimerInterface
{
    public function __construct(
        private ClientOnlineTable $clientOnlineTable,
        private ClientHistoryTable $clientHistoryTable,
        private ClientTimeTable $clientTimeTable,
        private TeamspeakService $teamspeakService,
    ) {
    }

    public function start(): void
    {
        try {
            $lastOnlineClients = $this->clientOnlineTable->getAll();
            $currentOnlineClients = $this->teamspeakService->getClients();

            foreach ($lastOnlineClients as $lastOnlineClient) {
                // Client went offline: Save message and delete from table
                if (!array_key_exists($lastOnlineClient['uuid'], $currentOnlineClients)) {
                    $this->clientHistoryTable->set($lastOnlineClient['uuid'], $lastOnlineClient['nickname'], StatusEnum::OFFLINE, time() - $lastOnlineClient['time']);
                    $this->clientOnlineTable->delete($lastOnlineClient['uuid']);
                }
            }

            foreach ($currentOnlineClients as $currentOnlineClient) {
                // Every tick update the client total online time
                $this->clientTimeTable->addSecond($currentOnlineClient->uuid, $currentOnlineClient->nickname,);

                // Client went online: Save message and add to table
                if (!array_key_exists($currentOnlineClient->uuid, $lastOnlineClients)) {
                    $this->clientHistoryTable->set($currentOnlineClient->uuid, $currentOnlineClient->nickname, StatusEnum::ONLINE, 999_999);
                    $this->clientOnlineTable->set($currentOnlineClient->uuid, $currentOnlineClient->nickname);
                }
            }
        } catch (Throwable $e) {
            echo $e->getMessage() . PHP_EOL;
        }
    }
}
