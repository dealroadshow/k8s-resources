<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PodReadinessGate contains the reference to a pod condition
 */
class PodReadinessGate implements JsonSerializable
{
    /**
     * ConditionType refers to a condition in the pod's condition list with matching
     * type.
     *
     * Possible enum values:
     *  - `"ContainersReady"` indicates whether all containers in the pod are ready.
     *  - `"Initialized"` means that all init containers in the pod have started
     * successfully.
     *  - `"PodScheduled"` represents status of the scheduling process for this pod.
     *  - `"Ready"` means the pod is able to service requests and should be added to
     * the load balancing pools of all matching services.
     */
    private string $conditionType;

    public function __construct(string $conditionType)
    {
        $this->conditionType = $conditionType;
    }

    public function getConditionType(): string
    {
        return $this->conditionType;
    }

    public function setConditionType(string $conditionType): self
    {
        $this->conditionType = $conditionType;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'conditionType' => $this->conditionType,
        ];
    }
}
