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
        return $this->formatSecondsToReadable(time() - $this->lastConnected);
    }

    public function getIdleTimeReadable(): string
    {
        return $this->formatSecondsToReadable((int) floor($this->idleTime / 1000));
    }

    private function formatSecondsToReadable(int $seconds): string
    {
        $hours = 0;
        if ($seconds > 3600) {
            $hours = floor($seconds / 3600);
            $seconds -= $hours * 3600;
        }

        $minutes = 0;
        if ($seconds > 60) {
            $minutes = floor($seconds / 60);
            $seconds -= $minutes * 60;
        }

        return sprintf("%02dh %02dm %02ds", $hours, $minutes, $seconds);
    }
}
