<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Interface;

use Swoole\Http\Response as SwooleResponse;

interface ResponseInterface
{
    public function send(SwooleResponse $swooleResponse): void;
}
