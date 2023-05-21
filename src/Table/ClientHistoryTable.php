<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Table;

use DateTime;
use DateTimeZone;
use Swoole\Table as SwooleTable;
use TeamspeakServerManager\Enum\StatusEnum;

final readonly class ClientHistoryTable
{
    private const MAX_MESSAGES = 100;

    private SwooleTable $swooleTable;

    public function __construct()
    {
        $this->swooleTable = new SwooleTable(128);

        $this->swooleTable->column('uuid', SwooleTable::TYPE_STRING, 255);
        $this->swooleTable->column('nickname', SwooleTable::TYPE_STRING, 255);
        $this->swooleTable->column('status', SwooleTable::TYPE_STRING, 50);
        $this->swooleTable->column('time', SwooleTable::TYPE_INT);
        $this->swooleTable->column('datetime', SwooleTable::TYPE_STRING, 50);

        $this->swooleTable->create();
    }

    /**
     * @return array<array{uuid: string, nickname: string, status: StatusEnum, time: int, datetime: string}>
     */
    public function getAll(): array
    {
        $histories = [];
        foreach ($this->swooleTable as $key => $values) {
            $values['status'] = StatusEnum::from($values['status']);
            $histories[(int) $key] = $values;
        }

        krsort($histories);

        return $histories;
    }

    public function set(string $uuid, string $nickname, StatusEnum $statusEnum, int $time): void
    {
        $this->swooleTable->set($this->getKey(), [
            'uuid' => $uuid,
            'nickname' => $nickname,
            'status' => $statusEnum->value,
            'time' => $time,
            'datetime' => (new DateTime('now', new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i:s'),
        ]);

        $this->checkTableSize();
    }

    public function delete(string $key): void
    {
        $this->swooleTable->delete($key);
    }

    private function getKey(): string
    {
        $keys = [];
        foreach ($this->swooleTable as $key => $values) {
            $keys[] = (int) $key;
        }

        if ($keys === []) {
            return '1';
        }

        return (string) (max($keys) + 1);
    }

    private function checkTableSize(): void
    {
        $keys = [];
        foreach ($this->swooleTable as $key => $values) {
            $keys[] = (int) $key;
        }

        while (count($keys) > self::MAX_MESSAGES) {
            $this->delete((string) min($keys));

            foreach ($keys as $index => $key) {
                if ($key === min($keys)) {
                    unset($keys[$index]);
                }
            }
        }
    }
}
