<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Middleware;

use TeamspeakServerManager\Enum\ContentTypeEnum;
use TeamspeakServerManager\Interface\MiddlewareInterface;
use TeamspeakServerManager\Stdlib\Renderer;
use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

final readonly class RenderMiddleware implements MiddlewareInterface
{
    public function __construct(
        private Renderer $renderer,
    ) {
    }

    public function handle(Request $request, Response $response): void
    {
        if ($response->getContentType() === ContentTypeEnum::HTML) {
            $response->setContent($this->renderer->render($response->getTemplate(), $response->getVars(), $response->getWithLayout()));
        }
    }
}
