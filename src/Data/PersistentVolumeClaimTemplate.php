<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PersistentVolumeClaimTemplate is used to produce PersistentVolumeClaim objects
 * as part of an EphemeralVolumeSource.
 */
class PersistentVolumeClaimTemplate implements JsonSerializable
{
    /**
     * May contain labels and annotations that will be copied into the PVC when
     * creating it. No other fields are allowed and will be rejected during validation.
     */
    private ObjectMeta $metadata;

    /**
     * The specification for the PersistentVolumeClaim. The entire content is copied
     * unchanged into the PVC that gets created from this template. The same fields as
     * in a PersistentVolumeClaim are also valid here.
     */
    private PersistentVolumeClaimSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PersistentVolumeClaimSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): PersistentVolumeClaimSpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): array
    {
        return [
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
