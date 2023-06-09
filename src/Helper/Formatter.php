<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Helper;

final readonly class Formatter
{
    public static function secondsToHumanReadable(int $seconds): string
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

    public static function secondsToHumanReadableWithDays(int $seconds): string
    {
        $days = 0;
        if ($seconds > 3600 * 24) {
            $days = floor($seconds / 3600 * 24);
            $seconds -= $days * 3600 * 24;
        }

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

        return sprintf("%02dd %02dh %02dm %02ds", $days, $hours, $minutes, $seconds);
    }
}
