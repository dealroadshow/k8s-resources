<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * EndpointAddress is a tuple that describes single IP address.
 */
class EndpointAddress implements JsonSerializable
{
    /**
     * The Hostname of this endpoint
     *
     * @var string|null
     */
    private ?string $hostname = null;

    /**
     * The IP of this endpoint. May not be loopback (127.0.0.0/8), link-local
     * (169.254.0.0/16), or link-local multicast ((224.0.0.0/24). IPv6 is also accepted
     * but not fully supported on all platforms. Also, certain kubernetes components,
     * like kube-proxy, are not IPv6 ready.
     */
    private string $ip;

    /**
     * Optional: Node hosting this endpoint. This can be used to determine endpoints
     * local to a node.
     *
     * @var string|null
     */
    private ?string $nodeName = null;

    /**
     * Reference to object providing the endpoint.
     */
    private ObjectReference $targetRef;

    public function __construct(string $ip)
    {
        $this->ip = $ip;
        $this->targetRef = new ObjectReference();
    }

    /**
     * @return string|null
     */
    public function getHostname(): ?string
    {
        return $this->hostname;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string|null
     */
    public function getNodeName(): ?string
    {
        return $this->nodeName;
    }

    public function setHostname(string $hostname): self
    {
        $this->hostname = $hostname;

        return $this;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function setNodeName(string $nodeName): self
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    public function targetRef(): ObjectReference
    {
        return $this->targetRef;
    }

    public function jsonSerialize()
    {
        return [
            'hostname' => $this->hostname,
            'ip' => $this->ip,
            'nodeName' => $this->nodeName,
            'targetRef' => $this->targetRef,
        ];
    }
}
