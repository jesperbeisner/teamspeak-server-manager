<?php

declare(strict_types=1);

namespace TeamspeakServerManager\DTO;

final readonly class ServerInfo
{
    public function __construct(
        public int $id,
        public string $uuid,
        public int $channelsOnline,
        public int $clientConnections,
        public int $clientsOnline,
        public int $created,
        public int $maxClients,
        public string $name,
        public string $welcomeMessage,
        public string $platform,
        public string $version,
        public int $port,
        public int $uptime,
    ) {
    }
}
