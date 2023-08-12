<?php

declare(strict_types=1);

namespace TeamspeakServerManager\DTO;

use DateTime;
use DateTimeZone;

final readonly class Client
{
    public function __construct(
        public int $id,
        public string $uuid,
        public int $databaseId,
        public string $nickname,
        public int $type,
        public int $idleTime,
        public string $ip,
        public int $channelId,
        public int $lastConnected,
    ) {
    }

    public function getLastConnectedReadable(): string
    {
        $dateTime = new DateTime();

        $dateTime->setTimestamp($this->lastConnected);
        $dateTime->setTimezone(new DateTimeZone('Europe/Berlin'));

        return $dateTime->format('d.m.Y H:i:s');
    }

    public function getOnlineReadable(): string
    {
        return secondsToHumanReadable(time() - $this->lastConnected);
    }

    public function getIdleTimeReadable(): string
    {
        return secondsToHumanReadable((int) floor($this->idleTime / 1000));
    }
}
