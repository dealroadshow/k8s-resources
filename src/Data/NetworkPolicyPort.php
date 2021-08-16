<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * NetworkPolicyPort describes a port to allow traffic on
 */
class NetworkPolicyPort implements JsonSerializable
{
    /**
     * If set, indicates that the range of ports from port to endPort, inclusive,
     * should be allowed by the policy. This field cannot be defined if the port field
     * is not defined or if the port field is defined as a named (string) port. The
     * endPort must be equal or greater than port. This feature is in Beta state and is
     * enabled by default. It can be disabled using the Feature Gate
     * "NetworkPolicyEndPort".
     */
    private int|null $endPort = null;

    /**
     * The port on the given protocol. This can either be a numerical or named port on
     * a pod. If this field is not provided, this matches all port names and numbers.
     * If present, only traffic on the specified protocol AND port will be matched.
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

    public function getEndPort(): int|null
    {
        return $this->endPort;
    }

    public function getPort(): string|int|null
    {
        return $this->port;
    }

    public function getProtocol(): string|null
    {
        return $this->protocol;
    }

    public function setEndPort(int $endPort): self
    {
        $this->endPort = $endPort;

        return $this;
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
            'endPort' => $this->endPort,
            'port' => $this->port,
            'protocol' => $this->protocol,
        ];
    }
}
