<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\NetworkPolicyPeerList;
use Dealroadshow\K8S\Data\Collection\NetworkPolicyPortList;
use JsonSerializable;

/**
 * NetworkPolicyIngressRule describes a particular set of traffic that is allowed
 * to the pods matched by a NetworkPolicySpec's podSelector. The traffic must match
 * both ports and from.
 */
class NetworkPolicyIngressRule implements JsonSerializable
{
    /**
     * List of sources which should be able to access the pods selected for this rule.
     * Items in this list are combined using a logical OR operation. If this field is
     * empty or missing, this rule matches all sources (traffic not restricted by
     * source). If this field is present and contains at least one item, this rule
     * allows traffic only if the traffic matches at least one item in the from list.
     */
    private NetworkPolicyPeerList $from;

    /**
     * List of ports which should be made accessible on the pods selected for this
     * rule. Each item in this list is combined using a logical OR. If this field is
     * empty or missing, this rule matches all ports (traffic not restricted by port).
     * If this field is present and contains at least one item, then this rule allows
     * traffic only if the traffic matches at least one port in the list.
     */
    private NetworkPolicyPortList $ports;

    public function __construct()
    {
        $this->from = new NetworkPolicyPeerList();
        $this->ports = new NetworkPolicyPortList();
    }

    public function from(): NetworkPolicyPeerList
    {
        return $this->from;
    }

    public function ports(): NetworkPolicyPortList
    {
        return $this->ports;
    }

    public function jsonSerialize()
    {
        return [
            'from' => $this->from,
            'ports' => $this->ports,
        ];
    }
}
