<?php

declare(strict_types=1);

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
     */
    private int|null $partition = null;

    public function __construct()
    {
    }

    public function getPartition(): int|null
    {
        return $this->partition;
    }

    public function setPartition(int $partition): self
    {
        $this->partition = $partition;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'partition' => $this->partition,
        ];
    }
}
