<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * SecretReference represents a Secret Reference. It has enough information to
 * retrieve secret in any namespace
 */
class SecretReference implements JsonSerializable
{
    /**
     * Name is unique within a namespace to reference a secret resource.
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * Namespace defines the space within which the secret name must be unique.
     *
     * @var string|null
     */
    private ?string $namespace = null;

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
    public function getNamespace(): ?string
    {
        return $this->namespace;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'namespace' => $this->namespace,
        ];
    }
}
