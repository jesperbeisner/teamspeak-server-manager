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

        $this->swooleTable->column('uuid', SwooleTable::TYPE_STRING, 50);
        $this->swooleTable->column('nickname', SwooleTable::TYPE_STRING, 50);
        $this->swooleTable->column('time', SwooleTable::TYPE_INT);

        $this->swooleTable->create();
    }

    public function addSecond(string $uuid, string $nickname): void
    {
        $values = $this->swooleTable->get($uuid);

        if (false === $values) {
            $this->swooleTable->set($uuid, ['uuid' => $uuid, 'nickname' => $nickname, 'time' => 1]);
        } else {
            $this->swooleTable->set($uuid, ['uuid' => $uuid, 'nickname' => $nickname, 'time' => $values['time'] + 1]);
        }
    }

    /**
     * @return array<array{uuid: string, nickname: string, time: int}>
     */
    public function getAll(): array
    {
        $times = [];
        foreach ($this->swooleTable as $values) {
            $times[] = $values;
        }

        return $times;
    }
}
