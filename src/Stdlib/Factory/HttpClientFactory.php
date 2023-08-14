<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib\Factory;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use TeamspeakServerManager\Interface\FactoryInterface;
use TeamspeakServerManager\Stdlib\Container;

final readonly class HttpClientFactory implements FactoryInterface
{
    public function build(Container $container): HttpClientInterface
    {
        return HttpClient::createForBaseUri('http://teamspeak-server:10080', [
            'headers' => [
                'X-Api-Key' => $_ENV['TEAMSPEAK_API_KEY'],
            ],
        ]);
    }
}
