<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib\Response;

use Swoole\Http\Response as SwooleResponse;
use TeamspeakServerManager\Interface\ResponseInterface;

final readonly class StaticResponse implements ResponseInterface
{
    private const CONTENT_TYPES = [
        'css' => 'text/css; charset=utf-8',
        'js' => 'text/javascript; charset=utf-8',
        'ico' => 'image/x-icon',
        'txt' => 'text/plain; charset=utf-8',
    ];

    /**
     * @param array<string, string> $headers
     */
    public function __construct(
        private string $fileName,
        private array $headers = [],
    ) {
    }

    public function send(SwooleResponse $swooleResponse): void
    {
        if (!file_exists($this->fileName)) {
            $swooleResponse->setStatusCode(404);
            $swooleResponse->setHeader('Content-Type', 'text/plain; charset=utf-8');
            $swooleResponse->end('404 - File does not exist.');

            return;
        }

        $extension = pathinfo($this->fileName, PATHINFO_EXTENSION);

        if (!array_key_exists($extension, StaticResponse::CONTENT_TYPES)) {
            $swooleResponse->setStatusCode(404);
            $swooleResponse->setHeader('Content-Type', 'text/plain; charset=utf-8');
            $swooleResponse->end('404 - File does not exist.');

            return;
        }

        $swooleResponse->setStatusCode(200);
        $swooleResponse->setHeader('Content-Type', StaticResponse::CONTENT_TYPES[$extension]);

        foreach ($this->headers as $key => $value) {
            $swooleResponse->setHeader($key, $value);
        }

        $swooleResponse->end(file_get_contents($this->fileName));
    }
}
