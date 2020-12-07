<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * HTTPHeader describes a custom header to be used in HTTP probes
 */
class HTTPHeader implements JsonSerializable
{
    /**
     * The header field name
     */
    private string $name;

    /**
     * The header field value
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
