<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * LimitResponse defines how to handle requests that can not be executed right now.
 */
class LimitResponse implements JsonSerializable
{
    /**
     * `queuing` holds the configuration parameters for queuing. This field may be
     * non-empty only if `type` is `"Queue"`.
     */
    private QueuingConfiguration $queuing;

    /**
     * `type` is "Queue" or "Reject". "Queue" means that requests that can not be
     * executed upon arrival are held in a queue until they can be executed or a
     * queuing limit is reached. "Reject" means that requests that can not be executed
     * upon arrival are rejected. Required.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->queuing = new QueuingConfiguration();
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function queuing(): QueuingConfiguration
    {
        return $this->queuing;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'queuing' => $this->queuing,
            'type' => $this->type,
        ];
    }
}
