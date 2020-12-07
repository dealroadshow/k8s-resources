<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a Quobyte mount that lasts the lifetime of a pod. Quobyte volumes do
 * not support ownership management or SELinux relabeling.
 */
class QuobyteVolumeSource implements JsonSerializable
{
    /**
     * Group to map volume access to Default is no group
     */
    private string|null $group = null;

    /**
     * ReadOnly here will force the Quobyte volume to be mounted with read-only
     * permissions. Defaults to false.
     */
    private bool|null $readOnly = null;

    /**
     * Registry represents a single or multiple Quobyte Registry services specified as
     * a string as host:port pair (multiple entries are separated with commas) which
     * acts as the central registry for volumes
     */
    private string $registry;

    /**
     * Tenant owning the given Quobyte volume in the Backend Used with dynamically
     * provisioned Quobyte volumes, value is set by the plugin
     */
    private string|null $tenant = null;

    /**
     * User to map volume access to Defaults to serivceaccount user
     */
    private string|null $user = null;

    /**
     * Volume is a string that references an already created Quobyte volume by name.
     */
    private string $volume;

    public function __construct(string $registry, string $volume)
    {
        $this->registry = $registry;
        $this->volume = $volume;
    }

    public function getGroup(): string|null
    {
        return $this->group;
    }

    public function getReadOnly(): bool|null
    {
        return $this->readOnly;
    }

    public function getRegistry(): string
    {
        return $this->registry;
    }

    public function getTenant(): string|null
    {
        return $this->tenant;
    }

    public function getUser(): string|null
    {
        return $this->user;
    }

    public function getVolume(): string
    {
        return $this->volume;
    }

    public function setGroup(string $group): self
    {
        $this->group = $group;

        return $this;
    }

    public function setReadOnly(bool $readOnly): self
    {
        $this->readOnly = $readOnly;

        return $this;
    }

    public function setRegistry(string $registry): self
    {
        $this->registry = $registry;

        return $this;
    }

    public function setTenant(string $tenant): self
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setVolume(string $volume): self
    {
        $this->volume = $volume;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'group' => $this->group,
            'readOnly' => $this->readOnly,
            'registry' => $this->registry,
            'tenant' => $this->tenant,
            'user' => $this->user,
            'volume' => $this->volume,
        ];
    }
}
