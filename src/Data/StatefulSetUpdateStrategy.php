<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * StatefulSetUpdateStrategy indicates the strategy that the StatefulSet controller
 * will use to perform updates. It includes any additional parameters necessary to
 * perform the update for the indicated strategy.
 */
class StatefulSetUpdateStrategy implements JsonSerializable
{
    /**
     * RollingUpdate is used to communicate parameters when Type is
     * RollingUpdateStatefulSetStrategyType.
     */
    private RollingUpdateStatefulSetStrategy $rollingUpdate;

    /**
     * Type indicates the type of the StatefulSetUpdateStrategy. Default is
     * RollingUpdate.
     *
     * Possible enum values:
     *  - `"OnDelete"` triggers the legacy behavior. Version tracking and ordered
     * rolling restarts are disabled. Pods are recreated from the StatefulSetSpec when
     * they are manually deleted. When a scale operation is performed with this
     * strategy,specification version indicated by the StatefulSet's currentRevision.
     *  - `"RollingUpdate"` indicates that update will be applied to all Pods in the
     * StatefulSet with respect to the StatefulSet ordering constraints. When a scale
     * operation is performed with this strategy, new Pods will be created from the
     * specification version indicated by the StatefulSet's updateRevision.
     */
    private string|null $type = null;

    public function __construct()
    {
        $this->rollingUpdate = new RollingUpdateStatefulSetStrategy();
    }

    public function getType(): string|null
    {
        return $this->type;
    }

    public function rollingUpdate(): RollingUpdateStatefulSetStrategy
    {
        return $this->rollingUpdate;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'rollingUpdate' => $this->rollingUpdate,
            'type' => $this->type,
        ];
    }
}
