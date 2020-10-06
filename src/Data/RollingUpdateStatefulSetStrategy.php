<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * RollingUpdateStatefulSetStrategy is used to communicate parameter for
 * RollingUpdateStatefulSetStrategyType.
 */
class RollingUpdateStatefulSetStrategy implements JsonSerializable
{
    /**
     * Partition indicates the ordinal at which the StatefulSet should be partitioned.
     * Default value is 0.
     *
     * @var int|null
     */
    private ?int $partition = null;

    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getPartition(): ?int
    {
        return $this->partition;
    }

    public function setPartition(int $partition): self
    {
        $this->partition = $partition;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'partition' => $this->partition,
        ];
    }
}
