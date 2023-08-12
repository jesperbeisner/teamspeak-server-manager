<?php

declare(strict_types=1);

namespace TeamspeakServerManager\Stdlib;

use RuntimeException;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class TeamspeakClient
{
    public function __construct(
        private HttpClientInterface $httpClient,
    ) {
    }

    /**
     * @return array<mixed>
     */
    public function request(string $url): array
    {
        $response = $this->httpClient->request('GET', $url);

        try {
            $body = $response->toArray(false);
        } catch (ExceptionInterface $e) {
            throw new RuntimeException(sprintf('Something went wrong when making a request to url "%s" - Message: "%s".', $url, $e->getMessage()));
        }

        if ($body['status']['code'] !== 0) {
            throw new RuntimeException(sprintf('Something went wrong when making a request to url "%s" - Code: "%d" - Message: "%s".', $url, $body['status']['code'], $body['status']['message']));
        }

        return $body['body'] ?? [];
    }
}
