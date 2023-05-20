<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Timer;

use DateTime;
use DateTimeZone;
use TeamspeakServerManager\Helper\Formatter;
use TeamspeakServerManager\Interface\TimerInterface;
use TeamspeakServerManager\Service\TeamspeakService;
use TeamspeakServerManager\Table\ClientTable;

final readonly class ClientTimer implements TimerInterface
{
    public function __construct(
        private ClientTable $clientTable,
        private TeamspeakService $teamspeakService,
    ) {
    }

    public function run(): void
    {
        $lastOnlineClients = $this->clientTable->getAll();
        $currentOnlineClients = $this->teamspeakService->getClients();

        foreach ($lastOnlineClients as $lastOnlineClient) {
            if (!array_key_exists($lastOnlineClient['uuid'], $currentOnlineClients)) {
                // Client went offline
                // Send message and delete from table
                $this->sendDiscordMessage(sprintf('User %s (UUID: %s) went offline after %s.', $lastOnlineClient['nickname'], $lastOnlineClient['uuid'], Formatter::secondsToHumanReadable(time() - $lastOnlineClient['time'])));
                $this->clientTable->delete($lastOnlineClient['uuid']);
            }
        }

        foreach ($currentOnlineClients as $currentOnlineClient) {
            if (!array_key_exists($currentOnlineClient->uuid, $lastOnlineClients)) {
                // Client went online
                // Send message and add to table
                $this->sendDiscordMessage(sprintf('User %s (UUID: %s) came online at %s.', $currentOnlineClient->nickname, $currentOnlineClient->uuid, (new DateTime('now', new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i:s')));
                $this->clientTable->set($currentOnlineClient);
            }
        }
    }

    private function sendDiscordMessage(string $message): void
    {
        @file_get_contents($_ENV['DISCORD_WEBHOOK'], false, stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/json",
                'content' => json_encode(['content' => $message]),
            ],
        ]));
    }
}
