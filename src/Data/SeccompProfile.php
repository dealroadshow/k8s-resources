<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * SeccompProfile defines a pod/container's seccomp profile settings. Only one
 * profile source may be set.
 */
class SeccompProfile implements JsonSerializable
{
    /**
     * localhostProfile indicates a profile defined in a file on the node should be
     * used. The profile must be preconfigured on the node to work. Must be a
     * descending path, relative to the kubelet's configured seccomp profile location.
     * Must only be set if type is "Localhost".
     */
    private string|null $localhostProfile = null;

    /**
     * type indicates which kind of seccomp profile will be applied. Valid options are:
     *
     * Localhost - a profile defined in a file on the node should be used.
     * RuntimeDefault - the container runtime default profile should be used.
     * Unconfined - no profile should be applied.
     */
    private string $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    public function getLocalhostProfile(): string|null
    {
        return $this->localhostProfile;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setLocalhostProfile(string $localhostProfile): self
    {
        $this->localhostProfile = $localhostProfile;

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'localhostProfile' => $this->localhostProfile,
            'type' => $this->type,
        ];
    }
}
