<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ResourceFieldSelector represents container resources (cpu, memory) and their
 * output format
 */
class ResourceFieldSelector implements JsonSerializable
{
    /**
     * Container name: required for volumes, optional for env vars
     */
    private string|null $containerName = null;

    /**
     * Specifies the output format of the exposed resources, defaults to "1"
     */
    private string|float|null $divisor = null;

    /**
     * Required: resource to select
     */
    private string $resource;

    public function __construct(string $resource)
    {
        $this->resource = $resource;
    }

    public function getContainerName(): string|null
    {
        return $this->containerName;
    }

    public function getDivisor(): string|float|null
    {
        return $this->divisor;
    }

    public function getResource(): string
    {
        return $this->resource;
    }

    public function setContainerName(string $containerName): self
    {
        $this->containerName = $containerName;

        return $this;
    }

    public function setDivisor(string|float $divisor): self
    {
        $this->divisor = $divisor;

        return $this;
    }

    public function setResource(string $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'containerName' => $this->containerName,
            'divisor' => $this->divisor,
            'resource' => $this->resource,
        ];
    }
}
