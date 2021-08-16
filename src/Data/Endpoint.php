<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringList;
use Dealroadshow\K8S\Data\Collection\StringMap;
use JsonSerializable;

/**
 * Endpoint represents a single logical "backend" implementing a service.
 */
class Endpoint implements JsonSerializable
{
    /**
     * addresses of this endpoint. The contents of this field are interpreted according
     * to the corresponding EndpointSlice addressType field. Consumers must handle
     * different types of addresses in the context of their own capabilities. This must
     * contain at least one address but no more than 100.
     */
    private StringList $addresses;

    /**
     * conditions contains information about the current status of the endpoint.
     */
    private EndpointConditions $conditions;

    /**
     * hostname of this endpoint. This field may be used by consumers of endpoints to
     * distinguish endpoints from each other (e.g. in DNS names). Multiple endpoints
     * which use the same hostname should be considered fungible (e.g. multiple A
     * values in DNS). Must be lowercase and pass DNS Label (RFC 1123) validation.
     */
    private string|null $hostname = null;

    /**
     * nodeName represents the name of the Node hosting this endpoint. This can be used
     * to determine endpoints local to a Node. This field can be enabled with the
     * EndpointSliceNodeName feature gate.
     */
    private string|null $nodeName = null;

    /**
     * targetRef is a reference to a Kubernetes object that represents this endpoint.
     */
    private ObjectReference $targetRef;

    /**
     * topology contains arbitrary topology information associated with the endpoint.
     * These key/value pairs must conform with the label format.
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/labels
     * Topology may include a maximum of 16 key/value pairs. This includes, but is not
     * limited to the following well known keys: * kubernetes.io/hostname: the value
     * indicates the hostname of the node
     *   where the endpoint is located. This should match the corresponding
     *   node label.
     * * topology.kubernetes.io/zone: the value indicates the zone where the
     *   endpoint is located. This should match the corresponding node label.
     * * topology.kubernetes.io/region: the value indicates the region where the
     *   endpoint is located. This should match the corresponding node label.
     * This field is deprecated and will be removed in future api versions.
     */
    private StringMap $topology;

    public function __construct()
    {
        $this->addresses = new StringList();
        $this->conditions = new EndpointConditions();
        $this->targetRef = new ObjectReference();
        $this->topology = new StringMap();
    }

    public function addresses(): StringList
    {
        return $this->addresses;
    }

    public function conditions(): EndpointConditions
    {
        return $this->conditions;
    }

    public function getHostname(): string|null
    {
        return $this->hostname;
    }

    public function getNodeName(): string|null
    {
        return $this->nodeName;
    }

    public function setHostname(string $hostname): self
    {
        $this->hostname = $hostname;

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

    public function topology(): StringMap
    {
        return $this->topology;
    }

    public function jsonSerialize(): array
    {
        return [
            'addresses' => $this->addresses,
            'conditions' => $this->conditions,
            'hostname' => $this->hostname,
            'nodeName' => $this->nodeName,
            'targetRef' => $this->targetRef,
            'topology' => $this->topology,
        ];
    }
}
