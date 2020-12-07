<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * NetworkPolicyPeer describes a peer to allow traffic from. Only certain
 * combinations of fields are allowed
 */
class NetworkPolicyPeer implements JsonSerializable
{
    /**
     * IPBlock defines policy on a particular IPBlock. If this field is set then
     * neither of the other fields can be.
     */
    private IPBlock|null $ipBlock = null;

    /**
     * Selects Namespaces using cluster-scoped labels. This field follows standard
     * label selector semantics; if present but empty, it selects all namespaces.
     *
     * If PodSelector is also set, then the NetworkPolicyPeer as a whole selects the
     * Pods matching PodSelector in the Namespaces selected by NamespaceSelector.
     * Otherwise it selects all Pods in the Namespaces selected by NamespaceSelector.
     */
    private LabelSelector $namespaceSelector;

    /**
     * This is a label selector which selects Pods. This field follows standard label
     * selector semantics; if present but empty, it selects all pods.
     *
     * If NamespaceSelector is also set, then the NetworkPolicyPeer as a whole selects
     * the Pods matching PodSelector in the Namespaces selected by NamespaceSelector.
     * Otherwise it selects the Pods matching PodSelector in the policy's own
     * Namespace.
     */
    private LabelSelector $podSelector;

    public function __construct()
    {
        $this->namespaceSelector = new LabelSelector();
        $this->podSelector = new LabelSelector();
    }

    public function getIpBlock(): IPBlock|null
    {
        return $this->ipBlock;
    }

    public function namespaceSelector(): LabelSelector
    {
        return $this->namespaceSelector;
    }

    public function podSelector(): LabelSelector
    {
        return $this->podSelector;
    }

    public function setIpBlock(IPBlock $ipBlock): self
    {
        $this->ipBlock = $ipBlock;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'ipBlock' => $this->ipBlock,
            'namespaceSelector' => $this->namespaceSelector,
            'podSelector' => $this->podSelector,
        ];
    }
}
