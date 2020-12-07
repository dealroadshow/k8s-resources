<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ScaleSpec describes the attributes of a scale subresource.
 */
class ScaleSpec implements JsonSerializable
{
    /**
     * desired number of instances for the scaled object.
     */
    private int|null $replicas = null;

    public function __construct()
    {
    }

    public function getReplicas(): int|null
    {
        return $this->replicas;
    }

    public function setReplicas(int $replicas): self
    {
        $this->replicas = $replicas;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'replicas' => $this->replicas,
        ];
    }
}
