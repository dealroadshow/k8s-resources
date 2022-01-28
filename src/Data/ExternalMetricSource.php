<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ExternalMetricSource indicates how to scale on a metric not associated with any
 * Kubernetes object (for example length of queue in cloud messaging service, or
 * QPS from loadbalancer running outside of cluster).
 */
class ExternalMetricSource implements JsonSerializable
{
    /**
     * metric identifies the target metric by name and selector
     */
    private MetricIdentifier $metric;

    /**
     * target specifies the target value for the given metric
     */
    private MetricTarget $target;

    public function __construct(MetricIdentifier $metric, MetricTarget $target)
    {
        $this->metric = $metric;
        $this->target = $target;
    }

    public function getMetric(): MetricIdentifier
    {
        return $this->metric;
    }

    public function getTarget(): MetricTarget
    {
        return $this->target;
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
            'metric' => $this->metric,
            'target' => $this->target,
        ];
    }
}
