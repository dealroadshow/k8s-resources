<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Resource;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ResourceClaimTemplateSpec;

/**
 * ResourceClaimTemplate is used to produce ResourceClaim objects.
 */
class ResourceClaimTemplate implements APIResourceInterface
{
    public const API_VERSION = 'resource.k8s.io/v1alpha1';
    public const KIND = 'ResourceClaimTemplate';

    /**
     * Standard object metadata
     */
    private ObjectMeta $metadata;

    /**
     * Describes the ResourceClaim that is to be generated.
     *
     * This field is immutable. A ResourceClaim will get created by the control plane
     * for a Pod when needed and then not get updated anymore.
     */
    private ResourceClaimTemplateSpec $spec;

    public function __construct(ResourceClaimTemplateSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): ResourceClaimTemplateSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(ResourceClaimTemplateSpec $spec): self
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
