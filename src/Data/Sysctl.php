<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Sysctl defines a kernel parameter to be set
 */
class Sysctl implements JsonSerializable
{
    /**
     * Name of a property to set
     */
    private string $name;

    /**
     * Value of a property to set
     */
    private string $value;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}
