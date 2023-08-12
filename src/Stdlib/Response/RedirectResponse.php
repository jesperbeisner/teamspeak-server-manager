<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib\Response;

use Swoole\Http\Response as SwooleResponse;
use TeamspeakServerManager\Interface\ResponseInterface;

final readonly class RedirectResponse implements ResponseInterface
{
    public function __construct(
        private string $location,
        private int $statusCode = 302,
    ) {
    }

    public function send(SwooleResponse $swooleResponse): void
    {
        $swooleResponse->redirect($this->location, $this->statusCode);
    }
}
