<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * HostPortRange defines a range of host ports that will be enabled by a policy for
 * pods to use.  It requires both the start and end to be defined. Deprecated: use
 * HostPortRange from policy API Group instead.
 */
class HostPortRange implements JsonSerializable
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
