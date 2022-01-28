<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PodDNSConfigOption defines DNS resolver options of a pod.
 */
class PodDNSConfigOption implements JsonSerializable
{
    /**
     * Required.
     */
    private string|null $name = null;
    private string|null $value = null;

    public function __construct()
    {
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getValue(): string|null
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
