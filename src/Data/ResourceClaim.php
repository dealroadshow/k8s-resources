<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ResourceClaim references one entry in PodSpec.ResourceClaims.
 */
class ResourceClaim implements JsonSerializable
{
    /**
     * Name must match the name of one entry in pod.spec.resourceClaims of the Pod
     * where this field is used. It makes that resource available inside a container.
     */
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
