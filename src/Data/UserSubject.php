<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * UserSubject holds detailed information for user-kind subject.
 */
class UserSubject implements JsonSerializable
{
    /**
     * `name` is the username that matches, or "*" to match all usernames. Required.
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
