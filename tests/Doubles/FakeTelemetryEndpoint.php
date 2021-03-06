<?php

declare(strict_types=1);

namespace Buddy\Repman\Tests\Doubles;

use Buddy\Repman\Service\Telemetry\Endpoint;
use Buddy\Repman\Service\Telemetry\Entry;

final class FakeTelemetryEndpoint implements Endpoint
{
    private bool $sent = false;

    public function send(Entry $entry): void
    {
        json_encode($entry);

        $this->sent = true;
    }

    public function sent(): bool
    {
        return $this->sent;
    }
}
