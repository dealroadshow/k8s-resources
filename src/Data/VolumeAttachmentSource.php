<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * VolumeAttachmentSource represents a volume that should be attached. Right now
 * only PersistenVolumes can be attached via external attacher, in future we may
 * allow also inline volumes in pods. Exactly one member can be set.
 */
class VolumeAttachmentSource implements JsonSerializable
{
    /**
     * inlineVolumeSpec contains all the information necessary to attach a persistent
     * volume defined by a pod's inline VolumeSource. This field is populated only for
     * the CSIMigration feature. It contains translated fields from a pod's inline
     * VolumeSource to a PersistentVolumeSpec. This field is alpha-level and is only
     * honored by servers that enabled the CSIMigration feature.
     */
    private PersistentVolumeSpec $inlineVolumeSpec;

    /**
     * Name of the persistent volume to attach.
     */
    private string|null $persistentVolumeName = null;

    public function __construct()
    {
        $this->inlineVolumeSpec = new PersistentVolumeSpec();
    }

    public function getPersistentVolumeName(): string|null
    {
        return $this->persistentVolumeName;
    }

    public function inlineVolumeSpec(): PersistentVolumeSpec
    {
        return $this->inlineVolumeSpec;
    }

    public function setPersistentVolumeName(string $persistentVolumeName): self
    {
        $this->persistentVolumeName = $persistentVolumeName;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'inlineVolumeSpec' => $this->inlineVolumeSpec,
            'persistentVolumeName' => $this->persistentVolumeName,
        ];
    }
}
