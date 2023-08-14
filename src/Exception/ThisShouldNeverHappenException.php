<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Exception;

use RuntimeException;

final class ThisShouldNeverHappenException extends RuntimeException
{
    public function __construct()
    {
        parent::__construct('This should never happen! ¯\_(ツ)_/¯');
    }
}
