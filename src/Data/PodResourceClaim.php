<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PodResourceClaim references exactly one ResourceClaim through a ClaimSource. It
 * adds a name to it that uniquely identifies the ResourceClaim inside the Pod.
 * Containers that need access to the ResourceClaim reference it with this name.
 */
class PodResourceClaim implements JsonSerializable
{
    /**
     * Name uniquely identifies this resource claim inside the pod. This must be a
     * DNS_LABEL.
     */
    private string $name;

    /**
     * Source describes where to find the ResourceClaim.
     */
    private ClaimSource $source;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->source = new ClaimSource();
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

    public function source(): ClaimSource
    {
        return $this->source;
    }

    public function jsonSerialize(): array
    {
        return [
            'name' => $this->name,
            'source' => $this->source,
        ];
    }
}
