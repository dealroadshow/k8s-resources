<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\ValueObject\Quantity;
use JsonSerializable;

/**
 * ResourceFieldSelector represents container resources (cpu, memory) and their
 * output format
 */
class ResourceFieldSelector implements JsonSerializable
{
    /**
     * Container name: required for volumes, optional for env vars
     *
     * @var string|null
     */
    private ?string $containerName = null;

    /**
     * Specifies the output format of the exposed resources, defaults to "1"
     *
     * @var Quantity|null
     */
    private ?Quantity $divisor = null;

    /**
     * Required: resource to select
     */
    private string $resource;

    public function __construct(string $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return string|null
     */
    public function getContainerName(): ?string
    {
        return $this->containerName;
    }

    /**
     * @return Quantity|null
     */
    public function getDivisor(): ?Quantity
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

    public function setDivisor(Quantity $divisor): self
    {
        $this->divisor = $divisor;

        return $this;
    }

    public function setResource(string $resource): self
    {
        $this->resource = $resource;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'containerName' => $this->containerName,
            'divisor' => $this->divisor,
            'resource' => $this->resource,
        ];
    }
}
