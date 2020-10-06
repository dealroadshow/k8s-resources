<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * AllowedCSIDriver represents a single inline CSI Driver that is allowed to be
 * used.
 */
class AllowedCSIDriver implements JsonSerializable
{
    /**
     * Name is the registered name of the CSI driver
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

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
        ];
    }
}
