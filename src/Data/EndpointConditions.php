<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * EndpointConditions represents the current condition of an endpoint.
 */
class EndpointConditions implements JsonSerializable
{
    /**
     * ready indicates that this endpoint is prepared to receive traffic, according to
     * whatever system is managing the endpoint. A nil value indicates an unknown
     * state. In most cases consumers should interpret this unknown state as ready. For
     * compatibility reasons, ready should never be "true" for terminating endpoints.
     */
    private bool|null $ready = null;

    /**
     * serving is identical to ready except that it is set regardless of the
     * terminating state of endpoints. This condition should be set to true for a ready
     * endpoint that is terminating. If nil, consumers should defer to the ready
     * condition.
     */
    private bool|null $serving = null;

    /**
     * terminating indicates that this endpoint is terminating. A nil value indicates
     * an unknown state. Consumers should interpret this unknown state to mean that the
     * endpoint is not terminating.
     */
    private bool|null $terminating = null;

    public function __construct()
    {
    }

    public function getReady(): bool|null
    {
        return $this->ready;
    }

    public function getServing(): bool|null
    {
        return $this->serving;
    }

    public function getTerminating(): bool|null
    {
        return $this->terminating;
    }

    public function setReady(bool $ready): self
    {
        $this->ready = $ready;

        return $this;
    }

    public function setServing(bool $serving): self
    {
        $this->serving = $serving;

        return $this;
    }

    public function setTerminating(bool $terminating): self
    {
        $this->terminating = $terminating;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'ready' => $this->ready,
            'serving' => $this->serving,
            'terminating' => $this->terminating,
        ];
    }
}
