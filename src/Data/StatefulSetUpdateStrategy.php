<?php 

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
     * @var string|null
     */
    private ?string $type = null;

    public function __construct()
    {
        $this->rollingUpdate = new RollingUpdateStatefulSetStrategy();
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
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

    public function jsonSerialize()
    {
        return [
            'rollingUpdate' => $this->rollingUpdate,
            'type' => $this->type,
        ];
    }
}
