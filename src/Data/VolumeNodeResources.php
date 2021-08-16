<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * VolumeNodeResources is a set of resource limits for scheduling of volumes.
 */
class VolumeNodeResources implements JsonSerializable
{
    /**
     * Maximum number of unique volumes managed by the CSI driver that can be used on a
     * node. A volume that is both attached and mounted on a node is considered to be
     * used once, not twice. The same rule applies for a unique volume that is shared
     * among multiple pods on the same node. If this field is not specified, then the
     * supported number of volumes on this node is unbounded.
     */
    private int|null $count = null;

    public function __construct()
    {
    }

    public function getCount(): int|null
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'count' => $this->count,
        ];
    }
}
