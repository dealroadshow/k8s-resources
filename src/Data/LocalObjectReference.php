<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * LocalObjectReference contains enough information to let you locate the
 * referenced object inside the same namespace.
 */
class LocalObjectReference implements JsonSerializable
{
    /**
     * Name of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     *
     * @var string|null
     */
    private ?string $name = null;

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

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
        ];
    }
}
