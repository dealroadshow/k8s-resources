<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * PriorityLevelConfigurationReference contains information that points to the
 * "request-priority" being used.
 */
class PriorityLevelConfigurationReference implements JsonSerializable
{
    /**
     * `name` is the name of the priority level configuration being referenced
     * Required.
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
