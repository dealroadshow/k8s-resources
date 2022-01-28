<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * GroupSubject holds detailed information for group-kind subject.
 */
class GroupSubject implements JsonSerializable
{
    /**
     * name is the user group that matches, or "*" to match all user groups. See
     * https://github.com/kubernetes/apiserver/blob/master/pkg/authentication/user/user.go
     * for some well-known group names. Required.
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
