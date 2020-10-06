<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * SecretEnvSource selects a Secret to populate the environment variables with.
 *
 * The contents of the target Secret's Data field will represent the key-value
 * pairs as environment variables.
 */
class SecretEnvSource implements JsonSerializable
{
    /**
     * Name of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * Specify whether the Secret must be defined
     *
     * @var bool|null
     */
    private ?bool $optional = null;

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
     * @return bool|null
     */
    public function getOptional(): ?bool
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

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'optional' => $this->optional,
        ];
    }
}
