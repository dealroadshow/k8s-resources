<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ParamRef references a parameter resource
 */
class ParamRef implements JsonSerializable
{
    /**
     * Name of the resource being referenced.
     */
    private string|null $name = null;

    /**
     * Namespace of the referenced resource. Should be empty for the cluster-scoped
     * resources
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
