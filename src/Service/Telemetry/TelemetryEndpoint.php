<?php

declare(strict_types=1);

namespace Buddy\Repman\Service\Telemetry;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final class TelemetryEndpoint implements Endpoint
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function send(Entry $entry): void
    {
        $response = $this->client->request(
            'POST',
            'https://telemetry.repman.io',
            [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode($entry),
            ]
        );

        if ($response->getStatusCode() >= 400) {
            throw new \RuntimeException(sprintf('Error while sending telemetry data. HTTP error: %d', $response->getStatusCode()));
        }
    }
}
