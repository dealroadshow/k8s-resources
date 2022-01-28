<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\NetworkPolicyPeerList;
use Dealroadshow\K8S\Data\Collection\NetworkPolicyPortList;
use JsonSerializable;

/**
 * NetworkPolicyEgressRule describes a particular set of traffic that is allowed
 * out of pods matched by a NetworkPolicySpec's podSelector. The traffic must match
 * both ports and to. This type is beta-level in 1.8
 */
class NetworkPolicyEgressRule implements JsonSerializable
{
    /**
     * List of destination ports for outgoing traffic. Each item in this list is
     * combined using a logical OR. If this field is empty or missing, this rule
     * matches all ports (traffic not restricted by port). If this field is present and
     * contains at least one item, then this rule allows traffic only if the traffic
     * matches at least one port in the list.
     */
    private NetworkPolicyPortList $ports;

    /**
     * List of destinations for outgoing traffic of pods selected for this rule. Items
     * in this list are combined using a logical OR operation. If this field is empty
     * or missing, this rule matches all destinations (traffic not restricted by
     * destination). If this field is present and contains at least one item, this rule
     * allows traffic only if the traffic matches at least one item in the to list.
     */
    private NetworkPolicyPeerList $to;

    public function __construct()
    {
        $this->ports = new NetworkPolicyPortList();
        $this->to = new NetworkPolicyPeerList();
    }

    public function ports(): NetworkPolicyPortList
    {
        return $this->ports;
    }

    public function to(): NetworkPolicyPeerList
    {
        return $this->to;
    }

    public function jsonSerialize(): array
    {
        return [
            'ports' => $this->ports,
            'to' => $this->to,
        ];
    }
}
