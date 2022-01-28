<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use Dealroadshow\K8S\Data\Collection\TaintList;
use JsonSerializable;

/**
 * NodeSpec describes the attributes that a node is created with.
 */
class NodeSpec implements JsonSerializable
{
    /**
     * If specified, the source to get node configuration from The DynamicKubeletConfig
     * feature gate must be enabled for the Kubelet to use this field
     */
    private NodeConfigSource $configSource;

    /**
     * Deprecated. Not all kubelets will set this field. Remove field after 1.13. see:
     * https://issues.k8s.io/61966
     */
    private string|null $externalID = null;

    /**
     * PodCIDR represents the pod IP range assigned to the node.
     */
    private string|null $podCIDR = null;

    /**
     * podCIDRs represents the IP ranges assigned to the node for usage by Pods on that
     * node. If this field is specified, the 0th entry must match the podCIDR field. It
     * may contain at most 1 value for each of IPv4 and IPv6.
     */
    private StringList $podCIDRs;

    /**
     * ID of the node assigned by the cloud provider in the format:
     * <ProviderName>://<ProviderSpecificNodeID>
     */
    private string|null $providerID = null;

    /**
     * If specified, the node's taints.
     */
    private TaintList $taints;

    /**
     * Unschedulable controls node schedulability of new pods. By default, node is
     * schedulable. More info:
     * https://kubernetes.io/docs/concepts/nodes/node/#manual-node-administration
     */
    private bool|null $unschedulable = null;

    public function __construct()
    {
        $this->configSource = new NodeConfigSource();
        $this->podCIDRs = new StringList();
        $this->taints = new TaintList();
    }

    public function configSource(): NodeConfigSource
    {
        return $this->configSource;
    }

    public function getExternalID(): string|null
    {
        return $this->externalID;
    }

    public function getPodCIDR(): string|null
    {
        return $this->podCIDR;
    }

    public function getProviderID(): string|null
    {
        return $this->providerID;
    }

    public function getUnschedulable(): bool|null
    {
        return $this->unschedulable;
    }

    public function podCIDRs(): StringList
    {
        return $this->podCIDRs;
    }

    public function setExternalID(string $externalID): self
    {
        $this->externalID = $externalID;

        return $this;
    }

    public function setPodCIDR(string $podCIDR): self
    {
        $this->podCIDR = $podCIDR;

        return $this;
    }

    public function setProviderID(string $providerID): self
    {
        $this->providerID = $providerID;

        return $this;
    }

    public function setUnschedulable(bool $unschedulable): self
    {
        $this->unschedulable = $unschedulable;

        return $this;
    }

    public function taints(): TaintList
    {
        return $this->taints;
    }

    public function jsonSerialize(): array
    {
        return [
            'configSource' => $this->configSource,
            'externalID' => $this->externalID,
            'podCIDR' => $this->podCIDR,
            'podCIDRs' => $this->podCIDRs,
            'providerID' => $this->providerID,
            'taints' => $this->taints,
            'unschedulable' => $this->unschedulable,
        ];
    }
}
