<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * SELinuxOptions are the labels to be applied to the container
 */
class SELinuxOptions implements JsonSerializable
{
    /**
     * Level is SELinux level label that applies to the container.
     */
    private string|null $level = null;

    /**
     * Role is a SELinux role label that applies to the container.
     */
    private string|null $role = null;

    /**
     * Type is a SELinux type label that applies to the container.
     */
    private string|null $type = null;

    /**
     * User is a SELinux user label that applies to the container.
     */
    private string|null $user = null;

    public function __construct()
    {
    }

    public function getLevel(): string|null
    {
        return $this->level;
    }

    public function getRole(): string|null
    {
        return $this->role;
    }

    public function getType(): string|null
    {
        return $this->type;
    }

    public function getUser(): string|null
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

    public function jsonSerialize(): array
    {
        return [
            'level' => $this->level,
            'role' => $this->role,
            'type' => $this->type,
            'user' => $this->user,
        ];
    }
}
