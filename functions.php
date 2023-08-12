<?php

declare(strict_types=1);

function escape(string $string): string
{
    return htmlspecialchars($string, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8');
}

function secondsToHumanReadable(int $seconds): string
{
    $days = floor($seconds / (24 * 60 * 60));
    $hours = floor(($seconds - ($days * 24 * 60 * 60)) / (60 * 60));
    $minutes = floor(($seconds - ($days * 24 * 60 * 60) - ($hours * 60 * 60)) / 60);
    $seconds = ($seconds - ($days * 24 * 60 * 60) - ($hours * 60 * 60) - ($minutes * 60)) % 60;

    return sprintf("%02dd %02dh %02dm %02ds", $days, $hours, $minutes, $seconds);
}
