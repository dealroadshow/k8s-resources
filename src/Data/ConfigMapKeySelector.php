<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Selects a key from a ConfigMap.
 */
class ConfigMapKeySelector implements JsonSerializable
{
    /**
     * The key to select.
     */
    private string $key;

    /**
     * Name of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * Specify whether the ConfigMap or its key must be defined
     *
     * @var bool|null
     */
    private ?bool $optional = null;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return bool|null
     */
    public function getOptional(): ?bool
    {
        return $this->optional;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

        return $this;
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

    public function jsonSerialize()
    {
        return [
            'key' => $this->key,
            'name' => $this->name,
            'optional' => $this->optional,
        ];
    }
}
