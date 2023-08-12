<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib\Response;

use Swoole\Http\Response as SwooleResponse;
use TeamspeakServerManager\Helper\Renderer;
use TeamspeakServerManager\Interface\ResponseInterface;

final readonly class HtmlResponse implements ResponseInterface
{
    /**
     * @param array<string, mixed> $vars
     * @param array<string, string> $headers
     */
    public function __construct(
        private string $template,
        private array $vars = [],
        private int $statusCode = 200,
        private array $headers = [],
        private bool $withLayout = true,
    ) {
    }

    public function send(SwooleResponse $swooleResponse): void
    {
        $swooleResponse->setStatusCode($this->statusCode);
        $swooleResponse->setHeader('Content-Type', 'text/html; charset=utf-8');

        foreach ($this->headers as $key => $value) {
            $swooleResponse->setHeader($key, $value);
        }

        $swooleResponse->end(Renderer::render($this->template, $this->vars, $this->withLayout));
    }
}
