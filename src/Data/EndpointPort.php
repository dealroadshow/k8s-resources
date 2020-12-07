<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * EndpointPort is a tuple that describes a single port.
 */
class EndpointPort implements JsonSerializable
{
    /**
     * The name of this port.  This must match the 'name' field in the corresponding
     * ServicePort. Must be a DNS_LABEL. Optional only if one port is defined.
     */
    private string|null $name = null;

    /**
     * The port number of the endpoint.
     */
    private int $port;

    /**
     * The IP protocol for this port. Must be UDP, TCP, or SCTP. Default is TCP.
     */
    private string|null $protocol = null;

    public function __construct(int $port)
    {
        $this->port = $port;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getProtocol(): string|null
    {
        return $this->protocol;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPort(int $port): self
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
            'name' => $this->name,
            'port' => $this->port,
            'protocol' => $this->protocol,
        ];
    }
}
