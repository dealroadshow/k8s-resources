<?php 

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
     * state. In most cases consumers should interpret this unknown state as ready.
     *
     * @var bool|null
     */
    private ?bool $ready = null;

    public function __construct()
    {
    }

    /**
     * @return bool|null
     */
    public function getReady(): ?bool
    {
        return $this->ready;
    }

    public function setReady(bool $ready): self
    {
        $this->ready = $ready;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'ready' => $this->ready,
        ];
    }
}
