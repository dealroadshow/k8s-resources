<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PodDNSConfigOption defines DNS resolver options of a pod.
 */
class PodDNSConfigOption implements JsonSerializable
{
    /**
     * Required.
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * @var string|null
     */
    private ?string $value = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
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

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
        ];
    }
}
