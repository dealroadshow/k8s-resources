<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Resource;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ResourceClaimSpec;

/**
 * ResourceClaim describes which resources are needed by a resource consumer. Its
 * status tracks whether the resource has been allocated and what the resulting
 * attributes are.
 *
 * This is an alpha type and requires enabling the DynamicResourceAllocation
 * feature gate.
 */
class ResourceClaim implements APIResourceInterface
{
    public const API_VERSION = 'resource.k8s.io/v1alpha1';
    public const KIND = 'ResourceClaim';

    /**
     * Standard object metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec describes the desired attributes of a resource that then needs to be
     * allocated. It can only be set once when creating the ResourceClaim.
     */
    private ResourceClaimSpec $spec;

    public function __construct(ResourceClaimSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): ResourceClaimSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(ResourceClaimSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
