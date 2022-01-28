<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * IDRange provides a min/max of an allowed range of IDs.
 */
class IDRange implements JsonSerializable
{
    /**
     * max is the end of the range, inclusive.
     */
    private int $max;

    /**
     * min is the start of the range, inclusive.
     */
    private int $min;

    public function __construct(int $max, int $min)
    {
        $this->max = $max;
        $this->min = $min;
    }

    public function getMax(): int
    {
        return $this->max;
    }

    public function getMin(): int
    {
        return $this->min;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'max' => $this->max,
            'min' => $this->min,
        ];
    }
}
