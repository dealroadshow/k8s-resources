<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * HPAScalingPolicy is a single policy which must hold true for a specified past
 * interval.
 */
class HPAScalingPolicy implements JsonSerializable
{
    /**
     * PeriodSeconds specifies the window of time for which the policy should hold
     * true. PeriodSeconds must be greater than zero and less than or equal to 1800 (30
     * min).
     */
    private int $periodSeconds;

    /**
     * Type is used to specify the scaling policy.
     */
    private string $type;

    /**
     * Value contains the amount of change which is permitted by the policy. It must be
     * greater than zero
     */
    private int $value;

    public function __construct(int $periodSeconds, string $type, int $value)
    {
        $this->periodSeconds = $periodSeconds;
        $this->type = $type;
        $this->value = $value;
    }

    public function getPeriodSeconds(): int
    {
        return $this->periodSeconds;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function setPeriodSeconds(int $periodSeconds): self
    {
        $this->periodSeconds = $periodSeconds;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'periodSeconds' => $this->periodSeconds,
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}
