<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * MetricIdentifier defines the name and optionally selector for a metric
 */
class MetricIdentifier implements JsonSerializable
{
    /**
     * name is the name of the given metric
     */
    private string $name;

    /**
     * selector is the string-encoded form of a standard kubernetes label selector for
     * the given metric When set, it is passed as an additional parameter to the
     * metrics server for more specific metrics scoping. When unset, just the
     * metricName will be used to gather metrics.
     */
    private LabelSelector $selector;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->selector = new LabelSelector();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function selector(): LabelSelector
    {
        return $this->selector;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'selector' => $this->selector,
        ];
    }
}
