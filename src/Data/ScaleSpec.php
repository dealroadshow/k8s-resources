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
     *
     * @var int|null
     */
    private ?int $replicas = null;

    public function __construct()
    {
    }

    /**
     * @return int|null
     */
    public function getReplicas(): ?int
    {
        return $this->replicas;
    }

    public function setReplicas(int $replicas): self
    {
        $this->replicas = $replicas;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'replicas' => $this->replicas,
        ];
    }
}
