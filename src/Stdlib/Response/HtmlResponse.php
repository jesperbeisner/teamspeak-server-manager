<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib\Response;

use Swoole\Http\Response as SwooleResponse;
use TeamspeakServerManager\Interface\ResponseInterface;
use TeamspeakServerManager\Stdlib\Renderer;

final class HtmlResponse implements ResponseInterface
{
    private Renderer $renderer;

    /**
     * @param array<string, mixed> $vars
     * @param array<string, string> $headers
     */
    public function __construct(
        private readonly string $template,
        private readonly array $vars = [],
        private readonly int $statusCode = 200,
        private readonly array $headers = [],
        private readonly bool $withLayout = true,
    ) {
    }

    public function setRenderer(Renderer $renderer): void
    {
        $this->renderer = $renderer;
    }

    public function send(SwooleResponse $swooleResponse): void
    {
        $swooleResponse->setStatusCode($this->statusCode);
        $swooleResponse->setHeader('Content-Type', 'text/html; charset=utf-8');

        foreach ($this->headers as $key => $value) {
            $swooleResponse->setHeader($key, $value);
        }

        $swooleResponse->end($this->renderer->render($this->template, $this->vars, $this->withLayout));
    }
}
