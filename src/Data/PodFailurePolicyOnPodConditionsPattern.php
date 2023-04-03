<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PodFailurePolicyOnPodConditionsPattern describes a pattern for matching an
 * actual pod condition type.
 */
class PodFailurePolicyOnPodConditionsPattern implements JsonSerializable
{
    /**
     * Specifies the required Pod condition type. To match a pod condition it is
     * required that specified type equals the pod condition type.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => $this->type,
        ];
    }
}
