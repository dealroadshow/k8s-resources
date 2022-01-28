<?php

declare(strict_types=1);

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
     */
    private string|null $name = null;

    /**
     * Namespace defines the space within which the secret name must be unique.
     */
    private string|null $namespace = null;

    public function __construct()
    {
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getNamespace(): string|null
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

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'namespace' => $this->namespace,
        ];
    }
}
