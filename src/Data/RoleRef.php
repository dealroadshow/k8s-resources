<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * RoleRef contains information that points to the role being used
 */
class RoleRef implements JsonSerializable
{
    /**
     * APIGroup is the group for the resource being referenced
     */
    private string $apiGroup;

    /**
     * Kind is the type of resource being referenced
     */
    private string $kind;

    /**
     * Name is the name of resource being referenced
     */
    private string $name;

    public function __construct(string $apiGroup, string $kind, string $name)
    {
        $this->apiGroup = $apiGroup;
        $this->kind = $kind;
        $this->name = $name;
    }

    public function getApiGroup(): string
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

    public function jsonSerialize()
    {
        return [
            'apiGroup' => $this->apiGroup,
            'kind' => $this->kind,
            'name' => $this->name,
        ];
    }
}
