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
     * The maximum number of pods that can be unavailable during the update. Value can
     * be an absolute number (ex: 5) or a percentage of desired pods (ex: 10%).
     * Absolute number is calculated from percentage by rounding up. This can not be 0.
     * Defaults to 1. This field is alpha-level and is only honored by servers that
     * enable the MaxUnavailableStatefulSet feature. The field applies to all pods in
     * the range 0 to Replicas-1. That means if there is any unavailable pod in the
     * range 0 to Replicas-1, it will be counted towards MaxUnavailable.
     */
    private string|int|null $maxUnavailable = null;

    /**
     * Partition indicates the ordinal at which the StatefulSet should be partitioned
     * for updates. During a rolling update, all pods from ordinal Replicas-1 to
     * Partition are updated. All pods from ordinal Partition-1 to 0 remain untouched.
     * This is helpful in being able to do a canary based deployment. The default value
     * is 0.
     */
    private int|null $partition = null;

    public function __construct()
    {
    }

    public function getMaxUnavailable(): string|int|null
    {
        return $this->maxUnavailable;
    }

    public function getPartition(): int|null
    {
        return $this->partition;
    }

    public function setMaxUnavailable(string|int $maxUnavailable): self
    {
        $this->maxUnavailable = $maxUnavailable;

        return $this;
    }

    public function setPartition(int $partition): self
    {
        $this->partition = $partition;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'maxUnavailable' => $this->maxUnavailable,
            'partition' => $this->partition,
        ];
    }
}
