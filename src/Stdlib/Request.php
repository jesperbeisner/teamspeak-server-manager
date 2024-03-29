<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use Swoole\Http\Request as SwooleRequest;
use TeamspeakServerManager\DTO\RouteInfo;
use TeamspeakServerManager\Exception\RuntimeException;
use TeamspeakServerManager\Interface\ControllerInterface;

final class Request
{
    private RouteInfo $routeInfo;
    private bool $stopPropagation = false;

    /**
     * @param array<string, mixed> $header
     * @param array<string, mixed> $server
     * @param array<string, mixed> $get
     * @param array<string, mixed> $post
     */
    public function __construct(
        private readonly array $header,
        private readonly array $server,
        private readonly array $get,
        private readonly array $post,
    ) {
    }

    public static function fromSwooleRequest(SwooleRequest $swooleRequest): Request
    {
        return new Request($swooleRequest->header, $swooleRequest->server, $swooleRequest->get ?? [], $swooleRequest->post ?? []);
    }

    public function getUri(): string
    {
        $uri = $this->server['request_uri'] ?? null;

        if (!is_string($uri)) {
            throw new RuntimeException('No request uri found?');
        }

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        return rawurldecode($uri);
    }

    public function getGet(string $key): ?string
    {
        return $this->get[$key] ?? null;
    }

    public function getMethod(): string
    {
        $requestMethod = $this->server['request_method'] ?? null;

        if (!is_string($requestMethod)) {
            throw new RuntimeException('No request method found?');
        }

        return strtoupper($requestMethod);
    }

    public function setRouteInfo(RouteInfo $routeInfo): void
    {
        if (isset($this->routeInfo)) {
            throw new RuntimeException('RouteInfo is already set!');
        }

        $this->routeInfo = $routeInfo;
    }

    /**
     * @return array<string, string>
     */
    public function getRouteVars(): array
    {
        if (isset($this->routeInfo)) {
            return $this->routeInfo->vars;
        }

        throw new RuntimeException('RouteInfo is not set yet, how?!');
    }

    /**
     * @return class-string<ControllerInterface>
     */
    public function getController(): string
    {
        if (isset($this->routeInfo)) {
            return $this->routeInfo->controller;
        }

        throw new RuntimeException('RouteInfo is not set yet, how?!');
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'POST';
    }

    public function isHxRequest(): bool
    {
        if (array_key_exists('hx-request', $this->header) && $this->header['hx-request'] === 'true') {
            return true;
        }

        return false;
    }

    public function stopPropagation(): void
    {
        $this->stopPropagation = true;
    }

    public function isPropagationStopped(): bool
    {
        return $this->stopPropagation;
    }
}
