<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * MetricTarget defines the target value, average value, or average utilization of
 * a specific metric
 */
class MetricTarget implements JsonSerializable
{
    /**
     * averageUtilization is the target value of the average of the resource metric
     * across all relevant pods, represented as a percentage of the requested value of
     * the resource for the pods. Currently only valid for Resource metric source type
     */
    private int|null $averageUtilization = null;

    /**
     * averageValue is the target value of the average of the metric across all
     * relevant pods (as a quantity)
     */
    private string|float|null $averageValue = null;

    /**
     * type represents whether the metric type is Utilization, Value, or AverageValue
     */
    private string $type;

    /**
     * value is the target value of the metric (as a quantity).
     */
    private string|float|null $value = null;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getAverageUtilization(): int|null
    {
        return $this->averageUtilization;
    }

    public function getAverageValue(): string|float|null
    {
        return $this->averageValue;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): string|float|null
    {
        return $this->value;
    }

    public function setAverageUtilization(int $averageUtilization): self
    {
        $this->averageUtilization = $averageUtilization;

        return $this;
    }

    public function setAverageValue(string|float $averageValue): self
    {
        $this->averageValue = $averageValue;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setValue(string|float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'averageUtilization' => $this->averageUtilization,
            'averageValue' => $this->averageValue,
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}
