<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ResourceClaimParametersReference contains enough information to let you locate
 * the parameters for a ResourceClaim. The object must be in the same namespace as
 * the ResourceClaim.
 */
class ResourceClaimParametersReference implements JsonSerializable
{
    /**
     * APIGroup is the group for the resource being referenced. It is empty for the
     * core API. This matches the group in the APIVersion that is used when creating
     * the resources.
     */
    private string|null $apiGroup = null;

    /**
     * Kind is the type of resource being referenced. This is the same value as in the
     * parameter object's metadata, for example "ConfigMap".
     */
    private string $kind;

    /**
     * Name is the name of resource being referenced.
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
