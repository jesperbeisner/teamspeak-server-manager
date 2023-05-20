<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Table;

use Swoole\Table as SwooleTable;
use TeamspeakServerManager\DTO\Client;

final readonly class ClientTable
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

    /**
     * @return array<array{uuid: string, nickname: string, time: int}>
     */
    public function getAll(): array
    {
        $clients = [];
        foreach ($this->swooleTable as $values) {
            $clients[$values['uuid']] = $values;
        }

        return $clients;
    }

    public function set(Client $client): void
    {
        $this->swooleTable->set($client->uuid, [
            'uuid' => $client->uuid,
            'nickname' => $client->nickname,
            'time' => time(),
        ]);
    }

    public function delete(string $uuid): void
    {
        $this->swooleTable->delete($uuid);
    }
}
