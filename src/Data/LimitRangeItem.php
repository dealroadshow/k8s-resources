<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\StringOrFloatMap;
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
    private StringOrFloatMap $default;

    /**
     * DefaultRequest is the default resource requirement request value by resource
     * name if resource request is omitted.
     */
    private StringOrFloatMap $defaultRequest;

    /**
     * Max usage constraints on this kind by resource name.
     */
    private StringOrFloatMap $max;

    /**
     * MaxLimitRequestRatio if specified, the named resource must have a request and
     * limit that are both non-zero where limit divided by request is less than or
     * equal to the enumerated value; this represents the max burst for the named
     * resource.
     */
    private StringOrFloatMap $maxLimitRequestRatio;

    /**
     * Min usage constraints on this kind by resource name.
     */
    private StringOrFloatMap $min;

    /**
     * Type of resource that this limit applies to.
     *
     * Possible enum values:
     *  - `"Container"` Limit that applies to all containers in a namespace
     *  - `"PersistentVolumeClaim"` Limit that applies to all persistent volume claims
     * in a namespace
     *  - `"Pod"` Limit that applies to all pods in a namespace
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->default = new StringOrFloatMap();
        $this->defaultRequest = new StringOrFloatMap();
        $this->max = new StringOrFloatMap();
        $this->maxLimitRequestRatio = new StringOrFloatMap();
        $this->min = new StringOrFloatMap();
        $this->type = $type;
    }

    public function default(): StringOrFloatMap
    {
        return $this->default;
    }

    public function defaultRequest(): StringOrFloatMap
    {
        return $this->defaultRequest;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function max(): StringOrFloatMap
    {
        return $this->max;
    }

    public function maxLimitRequestRatio(): StringOrFloatMap
    {
        return $this->maxLimitRequestRatio;
    }

    public function min(): StringOrFloatMap
    {
        return $this->min;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): array
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
