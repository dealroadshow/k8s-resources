<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ResourceClaimTemplateSpec contains the metadata and fields for a ResourceClaim.
 */
class ResourceClaimTemplateSpec implements JsonSerializable
{
    /**
     * ObjectMeta may contain labels and annotations that will be copied into the PVC
     * when creating it. No other fields are allowed and will be rejected during
     * validation.
     */
    private ObjectMeta $metadata;

    /**
     * Spec for the ResourceClaim. The entire content is copied unchanged into the
     * ResourceClaim that gets created from this template. The same fields as in a
     * ResourceClaim are also valid here.
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
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
