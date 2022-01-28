<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ContainerResourceMetricSource indicates how to scale on a resource metric known
 * to Kubernetes, as specified in requests and limits, describing each pod in the
 * current scale target (e.g. CPU or memory).  The values will be averaged together
 * before being compared to the target.  Such metrics are built in to Kubernetes,
 * and have special scaling options on top of those available to normal per-pod
 * metrics using the "pods" source.  Only one "target" type should be set.
 */
class ContainerResourceMetricSource implements JsonSerializable
{
    /**
     * container is the name of the container in the pods of the scaling target
     */
    private string $container;

    /**
     * name is the name of the resource in question.
     */
    private string $name;

    /**
     * target specifies the target value for the given metric
     */
    private MetricTarget $target;

    public function __construct(string $container, string $name, MetricTarget $target)
    {
        $this->container = $container;
        $this->name = $name;
        $this->target = $target;
    }

    public function getContainer(): string
    {
        return $this->container;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTarget(): MetricTarget
    {
        return $this->target;
    }

    public function setContainer(string $container): self
    {
        $this->container = $container;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            'container' => $this->container,
            'name' => $this->name,
            'target' => $this->target,
        ];
    }
}
