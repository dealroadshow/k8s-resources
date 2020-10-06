<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\IntOrString;
use JsonSerializable;

/**
 * NetworkPolicyPort describes a port to allow traffic on
 */
class NetworkPolicyPort implements JsonSerializable
{
    /**
     * The port on the given protocol. This can either be a numerical or named port on
     * a pod. If this field is not provided, this matches all port names and numbers.
     *
     * @var IntOrString|null
     */
    private ?IntOrString $port = null;

    /**
     * The protocol (TCP, UDP, or SCTP) which traffic must match. If not specified,
     * this field defaults to TCP.
     *
     * @var string|null
     */
    private ?string $protocol = null;

    public function __construct()
    {
    }

    /**
     * @return IntOrString|null
     */
    public function getPort(): ?IntOrString
    {
        return $this->port;
    }

    /**
     * @return string|null
     */
    public function getProtocol(): ?string
    {
        return $this->protocol;
    }

    public function setPort(IntOrString $port): self
    {
        $this->port = $port;

        return $this;
    }

    public function setProtocol(string $protocol): self
    {
        $this->protocol = $protocol;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'port' => $this->port,
            'protocol' => $this->protocol,
        ];
    }
}
