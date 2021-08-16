<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * ForZone provides information about which zones should consume this endpoint.
 */
class ForZone implements JsonSerializable
{
    /**
     * name represents the name of the zone.
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
