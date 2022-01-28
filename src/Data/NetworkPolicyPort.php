<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * NetworkPolicyPort describes a port to allow traffic on
 */
class NetworkPolicyPort implements JsonSerializable
{
    /**
     * The port on the given protocol. This can either be a numerical or named port on
     * a pod. If this field is not provided, this matches all port names and numbers.
     */
    private string|int|null $port = null;

    /**
     * The protocol (TCP, UDP, or SCTP) which traffic must match. If not specified,
     * this field defaults to TCP.
     */
    private string|null $protocol = null;

    public function __construct()
    {
    }

    public function getPort(): string|int|null
    {
        return $this->port;
    }

    public function getProtocol(): string|null
    {
        return $this->protocol;
    }

    public function setPort(string|int $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function setProtocol(string $protocol): self
    {
        $this->protocol = $protocol;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'port' => $this->port,
            'protocol' => $this->protocol,
        ];
    }
}
