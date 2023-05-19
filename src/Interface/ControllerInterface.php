<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Interface;

use TeamspeakServerManager\Stdlib\Request;
use TeamspeakServerManager\Stdlib\Response;

interface ControllerInterface
{
    public function execute(Request $request): Response;
}
