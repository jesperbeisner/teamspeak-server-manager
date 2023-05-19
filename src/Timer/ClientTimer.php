<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Timer;

use TeamspeakServerManager\Interface\TimerInterface;
use TeamspeakServerManager\Service\TeamspeakService;

final readonly class ClientTimer implements TimerInterface
{
    public function __construct(
        private TeamspeakService $teamspeakService,
    ) {
    }

    public function run(): void
    {
        $clients = $this->teamspeakService->getClients();
    }
}
