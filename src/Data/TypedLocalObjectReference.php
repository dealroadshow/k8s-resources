<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * TypedLocalObjectReference contains enough information to let you locate the
 * typed referenced object inside the same namespace.
 */
class TypedLocalObjectReference implements JsonSerializable
{
    /**
     * APIGroup is the group for the resource being referenced. If APIGroup is not
     * specified, the specified Kind must be in the core API group. For any other
     * third-party types, APIGroup is required.
     */
    private string|null $apiGroup = null;

    /**
     * Kind is the type of resource being referenced
     */
    private string $kind;

    /**
     * Name is the name of resource being referenced
     */
    private string $name;

    public function __construct(string $kind, string $name)
    {
        $this->kind = $kind;
        $this->name = $name;
    }

    public function getApiGroup(): string|null
    {
        return $this->apiGroup;
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setApiGroup(string $apiGroup): self
    {
        $this->apiGroup = $apiGroup;

        return $this;
    }

    public function setKind(string $kind): self
    {
        $this->kind = $kind;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiGroup' => $this->apiGroup,
            'kind' => $this->kind,
            'name' => $this->name,
        ];
    }
}
