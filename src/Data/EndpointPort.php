<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * EndpointPort is a tuple that describes a single port.
 */
class EndpointPort implements JsonSerializable
{
    /**
     * The application protocol for this port. This field follows standard Kubernetes
     * label syntax. Un-prefixed names are reserved for IANA standard service names (as
     * per RFC-6335 and http://www.iana.org/assignments/service-names). Non-standard
     * protocols should use prefixed names such as mycompany.com/my-custom-protocol.
     * This is a beta field that is guarded by the ServiceAppProtocol feature gate and
     * enabled by default.
     */
    private string|null $appProtocol = null;

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

    public function getAppProtocol(): string|null
    {
        return $this->appProtocol;
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

    public function setAppProtocol(string $appProtocol): self
    {
        $this->appProtocol = $appProtocol;

        return $this;
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
            'appProtocol' => $this->appProtocol,
            'name' => $this->name,
            'port' => $this->port,
            'protocol' => $this->protocol,
        ];
    }
}
