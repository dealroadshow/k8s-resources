<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PodSchedulingGate is associated to a Pod to guard its scheduling.
 */
class PodSchedulingGate implements JsonSerializable
{
    /**
     * Name of the scheduling gate. Each scheduling gate must have a unique name field.
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
