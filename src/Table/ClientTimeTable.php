<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Table;

use Swoole\Table as SwooleTable;

final readonly class ClientTimeTable
{
    private SwooleTable $swooleTable;

    public function __construct()
    {
        $this->swooleTable = new SwooleTable(1024);

        $this->swooleTable->column('uuid', SwooleTable::TYPE_STRING, 255);
        $this->swooleTable->column('nickname', SwooleTable::TYPE_STRING, 255);
        $this->swooleTable->column('time', SwooleTable::TYPE_INT);

        $this->swooleTable->create();
    }
}
