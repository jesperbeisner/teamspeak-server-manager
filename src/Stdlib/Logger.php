<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use DateTime;
use DateTimeZone;
use TeamspeakServerManager\Enum\LogLevelEnum;
use TeamspeakServerManager\Exception\RuntimeException;

final readonly class Logger
{
    public function __construct(
        private string $logFile,
    ) {
    }

    public function log(LogLevelEnum $logLevel, string $message, array $context = []): void
    {
        if (!is_file($this->logFile)) {
            if (false === touch($this->logFile)) {
                throw new RuntimeException(sprintf('Log file "%s" was not a file and could not be created.', $this->logFile));
            }
        }

        if (!is_writable($this->logFile)) {
            throw new RuntimeException(sprintf('Log file "%s" is not writable.', $this->logFile));
        }

        if (false === $file = fopen($this->logFile, 'a')) {
            throw new RuntimeException(sprintf('Could not open log file "%s".', $this->logFile));
        }

        $dateTime = DateTime::createFromFormat('U.u', (string) microtime(true));
        $dateTime->setTimezone(new DateTimeZone('Europe/Berlin'));

        $json = json_encode($context, JSON_THROW_ON_ERROR);

        $data = sprintf('%s %s %s %s', $dateTime->format('m-d-Y H:i:s.u'), strtoupper($logLevel->value), $message, $json) . PHP_EOL;

        if (false === fwrite($file, $data)) {
            throw new RuntimeException(sprintf('Could not write to log file "%s".', $this->logFile));
        }

        if (false === fclose($file)) {
            throw new RuntimeException(sprintf('Could not close log file "%s".', $this->logFile));
        }
    }

    public function error(string $message, array $context = []): void
    {
        $this->log(LogLevelEnum::ERROR, $message, $context);
    }

    public function info(string $message, array $context = []): void
    {
        $this->log(LogLevelEnum::INFO, $message, $context);
    }
}
