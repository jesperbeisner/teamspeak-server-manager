<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Timer;

use TeamspeakServerManager\Enum\StatusEnum;
use TeamspeakServerManager\Interface\TimerInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Table\ClientHistoryTable;
use TeamspeakServerManager\Table\ClientTable;
use TeamspeakServerManager\Table\ClientTimeTable;

final readonly class ClientTimer implements TimerInterface
{
    public function __construct(
        private ClientTable $clientTable,
        private ClientHistoryTable $clientHistoryTable,
        private ClientTimeTable $clientTimeTable,
        private TeamspeakService $teamspeakService,
    ) {
    }

    public function run(): void
    {
        $lastOnlineClients = $this->clientTable->getAll();
        $currentOnlineClients = $this->teamspeakService->getClients();

        foreach ($lastOnlineClients as $lastOnlineClient) {
            // Client went offline: Save message and delete from table
            if (!array_key_exists($lastOnlineClient['uuid'], $currentOnlineClients)) {
                $this->clientHistoryTable->set(
                    $lastOnlineClient['uuid'],
                    $lastOnlineClient['nickname'],
                    StatusEnum::OFFLINE,
                    time() - $lastOnlineClient['time'],
                );

                $this->clientTable->delete($lastOnlineClient['uuid']);
            }
        }

        foreach ($currentOnlineClients as $currentOnlineClient) {
            // Client wenn online: Save message and add to table
            if (!array_key_exists($currentOnlineClient->uuid, $lastOnlineClients)) {
                $this->clientHistoryTable->set(
                    $currentOnlineClient->uuid,
                    $currentOnlineClient->nickname,
                    StatusEnum::ONLINE,
                    999_999,
                );

                $this->clientTable->set($currentOnlineClient->uuid, $currentOnlineClient->nickname);
            }
        }
    }
}
