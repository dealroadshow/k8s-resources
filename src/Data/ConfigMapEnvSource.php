<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ConfigMapEnvSource selects a ConfigMap to populate the environment variables
 * with.
 *
 * The contents of the target ConfigMap's Data field will represent the key-value
 * pairs as environment variables.
 */
class ConfigMapEnvSource implements JsonSerializable
{
    /**
     * Name of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     */
    private string|null $name = null;

    /**
     * Specify whether the ConfigMap must be defined
     */
    private bool|null $optional = null;

    public function __construct()
    {
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getOptional(): bool|null
    {
        return $this->optional;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setOptional(bool $optional): self
    {
        $this->optional = $optional;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'optional' => $this->optional,
        ];
    }
}
