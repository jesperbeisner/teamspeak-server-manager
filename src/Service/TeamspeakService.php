<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Service;

use TeamspeakServerManager\DTO\Client;
use TeamspeakServerManager\DTO\ServerInfo;
use TeamspeakServerManager\Stdlib\TeamspeakClient;

final readonly class TeamspeakService
{
    public function __construct(
        private TeamspeakClient $teamspeakClient,
    ) {
    }

    public function getServerInfo(): ServerInfo
    {
        $response = $this->teamspeakClient->request('/1/serverinfo');

        return new ServerInfo(
            (int) $response[0]['virtualserver_id'],
            $response[0]['virtualserver_unique_identifier'],
            (int) $response[0]['virtualserver_channelsonline'],
            (int) $response[0]['virtualserver_client_connections'],
            (int) $response[0]['virtualserver_clientsonline'],
            (int) $response[0]['virtualserver_created'],
            (int) $response[0]['virtualserver_maxclients'],
            $response[0]['virtualserver_name'],
            $response[0]['virtualserver_welcomemessage'],
            $response[0]['virtualserver_platform'],
            $response[0]['virtualserver_version'],
            (int) $response[0]['virtualserver_port'],
            (int) $response[0]['virtualserver_uptime'],
        );
    }

    /**
     * @return array<Client>
     */
    public function getClients(): array
    {
        $response = $this->teamspeakClient->request('/1/clientlist?-uid&-ip&-times');

        $clients = [];
        foreach ($response as $clientInfo) {
            if ($clientInfo['client_unique_identifier'] === 'serveradmin') {
                continue;
            }

            $clients[$clientInfo['client_unique_identifier']] = new Client(
                (int) $clientInfo['clid'],
                $clientInfo['client_unique_identifier'],
                (int) $clientInfo['client_database_id'],
                $clientInfo['client_nickname'],
                (int) $clientInfo['client_type'],
                (int) $clientInfo['client_idle_time'],
                $clientInfo['connection_client_ip'],
                (int) $clientInfo['cid'],
                (int) $clientInfo['client_lastconnected'],
            );
        }

        return $clients;
    }
}
