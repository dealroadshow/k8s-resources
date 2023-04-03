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
