<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ObjectMetricSource indicates how to scale on a metric describing a kubernetes
 * object (for example, hits-per-second on an Ingress object).
 */
class ObjectMetricSource implements JsonSerializable
{
    /**
     * describedObject specifies the descriptions of a object,such as kind,name
     * apiVersion
     */
    private CrossVersionObjectReference $describedObject;

    /**
     * metric identifies the target metric by name and selector
     */
    private MetricIdentifier $metric;

    /**
     * target specifies the target value for the given metric
     */
    private MetricTarget $target;

    public function __construct(
        CrossVersionObjectReference $describedObject,
        MetricIdentifier $metric,
        MetricTarget $target
    ) {
        $this->describedObject = $describedObject;
        $this->metric = $metric;
        $this->target = $target;
    }

    public function getDescribedObject(): CrossVersionObjectReference
    {
        return $this->describedObject;
    }

    public function getMetric(): MetricIdentifier
    {
        return $this->metric;
    }

    public function getTarget(): MetricTarget
    {
        return $this->target;
    }

    public function setDescribedObject(CrossVersionObjectReference $describedObject): self
    {
        $this->describedObject = $describedObject;

        return $this;
    }

    public function setMetric(MetricIdentifier $metric): self
    {
        $this->metric = $metric;

        return $this;
    }

    public function setTarget(MetricTarget $target): self
    {
        $this->target = $target;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'describedObject' => $this->describedObject,
            'metric' => $this->metric,
            'target' => $this->target,
        ];
    }
}
