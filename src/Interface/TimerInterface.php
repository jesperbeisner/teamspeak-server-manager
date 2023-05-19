<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Interface;

interface TimerInterface
{
    public function run(): void;
}
