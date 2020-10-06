<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * SELinuxOptions are the labels to be applied to the container
 */
class SELinuxOptions implements JsonSerializable
{
    /**
     * Level is SELinux level label that applies to the container.
     *
     * @var string|null
     */
    private ?string $level = null;

    /**
     * Role is a SELinux role label that applies to the container.
     *
     * @var string|null
     */
    private ?string $role = null;

    /**
     * Type is a SELinux type label that applies to the container.
     *
     * @var string|null
     */
    private ?string $type = null;

    /**
     * User is a SELinux user label that applies to the container.
     *
     * @var string|null
     */
    private ?string $user = null;

    public function __construct()
    {
    }

    /**
     * @return string|null
     */
    public function getLevel(): ?string
    {
        return $this->level;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'level' => $this->level,
            'role' => $this->role,
            'type' => $this->type,
            'user' => $this->user,
        ];
    }
}
