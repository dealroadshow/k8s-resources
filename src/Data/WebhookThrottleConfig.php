<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * WebhookThrottleConfig holds the configuration for throttling events
 */
class WebhookThrottleConfig implements JsonSerializable
{
    /**
     * ThrottleBurst is the maximum number of events sent at the same moment default 15
     * QPS
     */
    private int|null $burst = null;

    /**
     * ThrottleQPS maximum number of batches per second default 10 QPS
     */
    private int|null $qps = null;

    public function __construct()
    {
    }

    public function getBurst(): int|null
    {
        return $this->burst;
    }

    public function getQps(): int|null
    {
        return $this->qps;
    }

    public function setBurst(int $burst): self
    {
        $this->burst = $burst;

        return $this;
    }

    public function setQps(int $qps): self
    {
        $this->qps = $qps;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'burst' => $this->burst,
            'qps' => $this->qps,
        ];
    }
}
