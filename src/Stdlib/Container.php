<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use RuntimeException;

final class Container
{
    private array $services = [];

    public function __construct(
        private readonly array $servicesConfig,
    ) {
    }

    /**
     * @param class-string $id
     */
    public function get(string $id): object
    {
        if (array_key_exists($id, $this->services)) {
            return $this->services[$id];
        }

        if (array_key_exists($id, $this->servicesConfig)) {
            return $this->services[$id] = (new $this->servicesConfig[$id]())->build($this);
        }

        throw new RuntimeException('Service does not exist. Did you forget to register this service?');
    }

    /**
     * @param class-string $id
     * @param object $service
     */
    public function set(string $id, object $service): void
    {
        $this->services[$id] = $service;
    }
}
