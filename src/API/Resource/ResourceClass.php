<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Resource;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\NodeSelector;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ResourceClassParametersReference;

/**
 * ResourceClass is used by administrators to influence how resources are
 * allocated.
 *
 * This is an alpha type and requires enabling the DynamicResourceAllocation
 * feature gate.
 */
class ResourceClass implements APIResourceInterface
{
    public const API_VERSION = 'resource.k8s.io/v1alpha1';
    public const KIND = 'ResourceClass';

    /**
     * DriverName defines the name of the dynamic resource driver that is used for
     * allocation of a ResourceClaim that uses this class.
     *
     * Resource drivers have a unique name in forward domain order (acme.example.com).
     */
    private string $driverName;

    /**
     * Standard object metadata
     */
    private ObjectMeta $metadata;

    /**
     * ParametersRef references an arbitrary separate object that may hold parameters
     * that will be used by the driver when allocating a resource that uses this class.
     * A dynamic resource driver can distinguish between parameters stored here and and
     * those stored in ResourceClaimSpec.
     */
    private ResourceClassParametersReference|null $parametersRef = null;

    /**
     * Only nodes matching the selector will be considered by the scheduler when trying
     * to find a Node that fits a Pod when that Pod uses a ResourceClaim that has not
     * been allocated yet.
     *
     * Setting this field is optional. If null, all nodes are candidates.
     */
    private NodeSelector $suitableNodes;

    public function __construct(string $driverName)
    {
        $this->driverName = $driverName;
        $this->metadata = new ObjectMeta();
        $this->suitableNodes = new NodeSelector();
    }

    public function getDriverName(): string
    {
        return $this->driverName;
    }

    public function getParametersRef(): ResourceClassParametersReference|null
    {
        return $this->parametersRef;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setDriverName(string $driverName): self
    {
        $this->driverName = $driverName;

        return $this;
    }

    public function setParametersRef(ResourceClassParametersReference $parametersRef): self
    {
        $this->parametersRef = $parametersRef;

        return $this;
    }

    public function suitableNodes(): NodeSelector
    {
        return $this->suitableNodes;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'driverName' => $this->driverName,
            'metadata' => $this->metadata,
            'parametersRef' => $this->parametersRef,
            'suitableNodes' => $this->suitableNodes,
        ];
    }
}
