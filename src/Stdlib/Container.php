<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use RuntimeException;
use TeamspeakServerManager\Interface\FactoryInterface;

final class Container
{
    /** @var array<class-string, object> */
    private array $services = [];

    /**
     * @param array<string, class-string<FactoryInterface>> $factories
     */
    public function __construct(
        private readonly array $factories,
    ) {
    }

    /**
     * @template T of object
     * @param class-string<T> $key
     * @param T $value
     */
    public function set(string $key, object $value): void
    {
        $this->services[$key] = $value;
    }

    /**
     * @template T of object
     * @param class-string<T> $key
     * @return T
     */
    public function get(string $key): object
    {
        if (array_key_exists($key, $this->services)) {
            $service = $this->services[$key];

            if (!$service instanceof $key) {
                throw new RuntimeException(sprintf('Returned service is not an instance of "%s".', $key));
            }

            return $service;
        }

        if (array_key_exists($key, $this->factories)) {
            $this->services[$key] = (new $this->factories[$key]())->build($this);

            $service = $this->services[$key];

            if (!$service instanceof $key) {
                throw new RuntimeException(sprintf('Returned service is not an instance of "%s".', $key));
            }

            return $service;
        }

        throw new RuntimeException(sprintf('Service with key "%s" does not exist in the container. Did you forget to register it in the "config.php" file?', $key));
    }
}
