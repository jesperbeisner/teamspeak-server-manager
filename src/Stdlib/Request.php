<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use RuntimeException;
use Swoole\Http\Request as SwooleRequest;

final readonly class Request
{
    public function __construct(
        private array $header,
        private array $server,
        private array $get,
        private array $post,
    ) {
    }

    public static function fromSwooleRequest(SwooleRequest $swooleRequest): Request
    {
        return new Request($swooleRequest->header, $swooleRequest->server, $swooleRequest->get ?? [], $swooleRequest->post ?? []);
    }

    public function getUri(): string
    {
        $uri = $this->server['request_uri'] ?? throw new RuntimeException('No request uri found?');

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
        return strtoupper($this->server['request_method'] ?? throw new RuntimeException('No request method found?'));
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
}
