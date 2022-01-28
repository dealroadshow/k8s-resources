<?php

declare(strict_types=1);

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
     * deprecatedTopology contains topology information part of the v1beta1 API. This
     * field is deprecated, and will be removed when the v1beta1 API is removed (no
     * sooner than kubernetes v1.24).  While this field can hold values, it is not
     * writable through the v1 API, and any attempts to write to it will be silently
     * ignored. Topology information can be found in the zone and nodeName fields
     * instead.
     */
    private StringMap $deprecatedTopology;

    /**
     * hints contains information associated with how an endpoint should be consumed.
     */
    private EndpointHints $hints;

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
     * zone is the name of the Zone this endpoint exists in.
     */
    private string|null $zone = null;

    public function __construct()
    {
        $this->addresses = new StringList();
        $this->conditions = new EndpointConditions();
        $this->deprecatedTopology = new StringMap();
        $this->hints = new EndpointHints();
        $this->targetRef = new ObjectReference();
    }

    public function addresses(): StringList
    {
        return $this->addresses;
    }

    public function conditions(): EndpointConditions
    {
        return $this->conditions;
    }

    public function deprecatedTopology(): StringMap
    {
        return $this->deprecatedTopology;
    }

    public function getHostname(): string|null
    {
        return $this->hostname;
    }

    public function getNodeName(): string|null
    {
        return $this->nodeName;
    }

    public function getZone(): string|null
    {
        return $this->zone;
    }

    public function hints(): EndpointHints
    {
        return $this->hints;
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

    public function setZone(string $zone): self
    {
        $this->zone = $zone;

        return $this;
    }

    public function targetRef(): ObjectReference
    {
        return $this->targetRef;
    }

    public function jsonSerialize(): array
    {
        return [
            'addresses' => $this->addresses,
            'conditions' => $this->conditions,
            'deprecatedTopology' => $this->deprecatedTopology,
            'hints' => $this->hints,
            'hostname' => $this->hostname,
            'nodeName' => $this->nodeName,
            'targetRef' => $this->targetRef,
            'zone' => $this->zone,
        ];
    }
}
