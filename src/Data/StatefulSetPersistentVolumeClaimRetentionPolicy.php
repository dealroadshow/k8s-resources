<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * StatefulSetPersistentVolumeClaimRetentionPolicy describes the policy used for
 * PVCs created from the StatefulSet VolumeClaimTemplates.
 */
class StatefulSetPersistentVolumeClaimRetentionPolicy implements JsonSerializable
{
    /**
     * WhenDeleted specifies what happens to PVCs created from StatefulSet
     * VolumeClaimTemplates when the StatefulSet is deleted. The default policy of
     * `Retain` causes PVCs to not be affected by StatefulSet deletion. The `Delete`
     * policy causes those PVCs to be deleted.
     */
    private string|null $whenDeleted = null;

    /**
     * WhenScaled specifies what happens to PVCs created from StatefulSet
     * VolumeClaimTemplates when the StatefulSet is scaled down. The default policy of
     * `Retain` causes PVCs to not be affected by a scaledown. The `Delete` policy
     * causes the associated PVCs for any excess pods above the replica count to be
     * deleted.
     */
    private string|null $whenScaled = null;

    public function __construct()
    {
    }

    public function getWhenDeleted(): string|null
    {
        return $this->whenDeleted;
    }

    public function getWhenScaled(): string|null
    {
        return $this->whenScaled;
    }

    public function setWhenDeleted(string $whenDeleted): self
    {
        $this->whenDeleted = $whenDeleted;

        return $this;
    }

    public function setWhenScaled(string $whenScaled): self
    {
        $this->whenScaled = $whenScaled;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'whenDeleted' => $this->whenDeleted,
            'whenScaled' => $this->whenScaled,
        ];
    }
}
