<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use RuntimeException;
use SplFileInfo;
use TeamspeakServerManager\Interface\ControllerInterface;
use TeamspeakServerManager\Interface\FactoryInterface;

final readonly class Config
{
    /** @var array<string, mixed> */
    private array $config;

    public function __construct(string $configDirectory)
    {
        $config = [];

        if (!is_dir($configDirectory)) {
            throw new RuntimeException(sprintf('Config directory "%s" is not a directory.', $configDirectory));
        }

        if (!is_readable($configDirectory)) {
            throw new RuntimeException(sprintf('Config directory "%s" is not readable.', $configDirectory));
        }

        if (false === $files = glob($configDirectory . '/*.php')) {
            throw new RuntimeException(sprintf('Could not glob config directory "%s".', $configDirectory));
        }

        foreach ($files as $file) {
            $file = new SplFileInfo($file);

            $fileConfig = require $file->getPathname();

            if (!is_array($fileConfig)) {
                throw new RuntimeException(sprintf('Config file "%s" did not return an array.', $file));
            }

            $config[$file->getBasename('.php')] = $fileConfig;
        }

        $this->config = $config;
    }

    /**
     * @return array<mixed>
     */
    public function get(string $key): array
    {
        return $this->config[$key];
    }

    public function getAppEnv(): string
    {
        return $this->config['app']['env'];
    }

    /**
     * @return  array<class-string, class-string<FactoryInterface>>
     */
    public function getServices(): array
    {
        return $this->config['services'];
    }

    /**
     * @return  array<array{url: string, methods: array<int, string>, controller: class-string<ControllerInterface>}>
     */
    public function getRoutes(): array
    {
        return $this->config['routes'];
    }
}
