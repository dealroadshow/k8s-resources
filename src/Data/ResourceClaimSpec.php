<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ResourceClaimSpec defines how a resource is to be allocated.
 */
class ResourceClaimSpec implements JsonSerializable
{
    /**
     * Allocation can start immediately or when a Pod wants to use the resource.
     * "WaitForFirstConsumer" is the default.
     */
    private string|null $allocationMode = null;

    /**
     * ParametersRef references a separate object with arbitrary parameters that will
     * be used by the driver when allocating a resource for the claim.
     *
     * The object must be in the same namespace as the ResourceClaim.
     */
    private ResourceClaimParametersReference|null $parametersRef = null;

    /**
     * ResourceClassName references the driver and additional parameters via the name
     * of a ResourceClass that was created as part of the driver deployment.
     */
    private string $resourceClassName;

    public function __construct(string $resourceClassName)
    {
        $this->resourceClassName = $resourceClassName;
    }

    public function getAllocationMode(): string|null
    {
        return $this->allocationMode;
    }

    public function getParametersRef(): ResourceClaimParametersReference|null
    {
        return $this->parametersRef;
    }

    public function getResourceClassName(): string
    {
        return $this->resourceClassName;
    }

    public function setAllocationMode(string $allocationMode): self
    {
        $this->allocationMode = $allocationMode;

        return $this;
    }

    public function setParametersRef(ResourceClaimParametersReference $parametersRef): self
    {
        $this->parametersRef = $parametersRef;

        return $this;
    }

    public function setResourceClassName(string $resourceClassName): self
    {
        $this->resourceClassName = $resourceClassName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'allocationMode' => $this->allocationMode,
            'parametersRef' => $this->parametersRef,
            'resourceClassName' => $this->resourceClassName,
        ];
    }
}
