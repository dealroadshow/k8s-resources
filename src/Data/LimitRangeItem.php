<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\QuantityMap;
use JsonSerializable;

/**
 * LimitRangeItem defines a min/max usage limit for any resource that matches on
 * kind.
 */
class LimitRangeItem implements JsonSerializable
{
    /**
     * Default resource requirement limit value by resource name if resource limit is
     * omitted.
     */
    private QuantityMap $default;

    /**
     * DefaultRequest is the default resource requirement request value by resource
     * name if resource request is omitted.
     */
    private QuantityMap $defaultRequest;

    /**
     * Max usage constraints on this kind by resource name.
     */
    private QuantityMap $max;

    /**
     * MaxLimitRequestRatio if specified, the named resource must have a request and
     * limit that are both non-zero where limit divided by request is less than or
     * equal to the enumerated value; this represents the max burst for the named
     * resource.
     */
    private QuantityMap $maxLimitRequestRatio;

    /**
     * Min usage constraints on this kind by resource name.
     */
    private QuantityMap $min;

    /**
     * Type of resource that this limit applies to.
     *
     * @var string|null
     */
    private ?string $type = null;

    public function __construct()
    {
        $this->default = new QuantityMap();
        $this->defaultRequest = new QuantityMap();
        $this->max = new QuantityMap();
        $this->maxLimitRequestRatio = new QuantityMap();
        $this->min = new QuantityMap();
    }

    public function default(): QuantityMap
    {
        return $this->default;
    }

    public function defaultRequest(): QuantityMap
    {
        return $this->defaultRequest;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    public function max(): QuantityMap
    {
        return $this->max;
    }

    public function maxLimitRequestRatio(): QuantityMap
    {
        return $this->maxLimitRequestRatio;
    }

    public function min(): QuantityMap
    {
        return $this->min;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'default' => $this->default,
            'defaultRequest' => $this->defaultRequest,
            'max' => $this->max,
            'maxLimitRequestRatio' => $this->maxLimitRequestRatio,
            'min' => $this->min,
            'type' => $this->type,
        ];
    }
}
