<?php 

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
     *
     * @var int|null
     */
    private ?int $burst = null;

    /**
     * ThrottleQPS maximum number of batches per second default 10 QPS
     *
     * @var int|null
     */
    private ?int $qps = null;

    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getBurst(): ?int
    {
        return $this->burst;
    }

    /**
     * @return int|null
     */
    public function getQps(): ?int
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

    public function jsonSerialize()
    {
        return [
            'burst' => $this->burst,
            'qps' => $this->qps,
        ];
    }
}
