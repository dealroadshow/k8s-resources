<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ClusterCIDRSpec defines the desired state of ClusterCIDR.
 */
class ClusterCIDRSpec implements JsonSerializable
{
    /**
     * IPv4 defines an IPv4 IP block in CIDR notation(e.g. "10.0.0.0/8"). At least one
     * of IPv4 and IPv6 must be specified. This field is immutable.
     */
    private string|null $ipv4 = null;

    /**
     * IPv6 defines an IPv6 IP block in CIDR notation(e.g. "2001:db8::/64"). At least
     * one of IPv4 and IPv6 must be specified. This field is immutable.
     */
    private string|null $ipv6 = null;

    /**
     * NodeSelector defines which nodes the config is applicable to. An empty or nil
     * NodeSelector selects all nodes. This field is immutable.
     */
    private NodeSelector $nodeSelector;

    /**
     * PerNodeHostBits defines the number of host bits to be configured per node. A
     * subnet mask determines how much of the address is used for network bits and host
     * bits. For example an IPv4 address of 192.168.0.0/24, splits the address into 24
     * bits for the network portion and 8 bits for the host portion. To allocate 256
     * IPs, set this field to 8 (a /24 mask for IPv4 or a /120 for IPv6). Minimum value
     * is 4 (16 IPs). This field is immutable.
     */
    private int $perNodeHostBits;

    public function __construct(int $perNodeHostBits)
    {
        $this->nodeSelector = new NodeSelector();
        $this->perNodeHostBits = $perNodeHostBits;
    }

    public function getIpv4(): string|null
    {
        return $this->ipv4;
    }

    public function getIpv6(): string|null
    {
        return $this->ipv6;
    }

    public function getPerNodeHostBits(): int
    {
        return $this->perNodeHostBits;
    }

    public function nodeSelector(): NodeSelector
    {
        return $this->nodeSelector;
    }

    public function setIpv4(string $ipv4): self
    {
        $this->ipv4 = $ipv4;

        return $this;
    }

    public function setIpv6(string $ipv6): self
    {
        $this->ipv6 = $ipv6;

        return $this;
    }

    public function setPerNodeHostBits(int $perNodeHostBits): self
    {
        $this->perNodeHostBits = $perNodeHostBits;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'ipv4' => $this->ipv4,
            'ipv6' => $this->ipv6,
            'nodeSelector' => $this->nodeSelector,
            'perNodeHostBits' => $this->perNodeHostBits,
        ];
    }
}
