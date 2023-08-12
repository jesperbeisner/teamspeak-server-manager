<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Interface;

use TeamspeakServerManager\Stdlib\Request;

interface ControllerInterface
{
    public function execute(Request $request): ResponseInterface;
}
