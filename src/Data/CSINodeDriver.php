<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use JsonSerializable;

/**
 * CSINodeDriver holds information about the specification of one CSI driver
 * installed on a node
 */
class CSINodeDriver implements JsonSerializable
{
    /**
     * allocatable represents the volume resources of a node that are available for
     * scheduling. This field is beta.
     */
    private VolumeNodeResources $allocatable;

    /**
     * This is the name of the CSI driver that this object refers to. This MUST be the
     * same name returned by the CSI GetPluginName() call for that driver.
     */
    private string $name;

    /**
     * nodeID of the node from the driver point of view. This field enables Kubernetes
     * to communicate with storage systems that do not share the same nomenclature for
     * nodes. For example, Kubernetes may refer to a given node as "node1", but the
     * storage system may refer to the same node as "nodeA". When Kubernetes issues a
     * command to the storage system to attach a volume to a specific node, it can use
     * this field to refer to the node name using the ID that the storage system will
     * understand, e.g. "nodeA" instead of "node1". This field is required.
     */
    private string $nodeID;

    /**
     * topologyKeys is the list of keys supported by the driver. When a driver is
     * initialized on a cluster, it provides a set of topology keys that it understands
     * (e.g. "company.com/zone", "company.com/region"). When a driver is initialized on
     * a node, it provides the same topology keys along with values. Kubelet will
     * expose these topology keys as labels on its own node object. When Kubernetes
     * does topology aware provisioning, it can use this list to determine which labels
     * it should retrieve from the node object and pass back to the driver. It is
     * possible for different nodes to use different topology keys. This can be empty
     * if driver does not support topology.
     */
    private StringList $topologyKeys;

    public function __construct(string $name, string $nodeID)
    {
        $this->allocatable = new VolumeNodeResources();
        $this->name = $name;
        $this->nodeID = $nodeID;
        $this->topologyKeys = new StringList();
    }

    public function allocatable(): VolumeNodeResources
    {
        return $this->allocatable;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNodeID(): string
    {
        return $this->nodeID;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNodeID(string $nodeID): self
    {
        $this->nodeID = $nodeID;

        return $this;
    }

    public function topologyKeys(): StringList
    {
        return $this->topologyKeys;
    }

    public function jsonSerialize(): array
    {
        return [
            'allocatable' => $this->allocatable,
            'name' => $this->name,
            'nodeID' => $this->nodeID,
            'topologyKeys' => $this->topologyKeys,
        ];
    }
}
