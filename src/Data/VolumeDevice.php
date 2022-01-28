<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * volumeDevice describes a mapping of a raw block device within a container.
 */
class VolumeDevice implements JsonSerializable
{
    /**
     * devicePath is the path inside of the container that the device will be mapped
     * to.
     */
    private string $devicePath;

    /**
     * name must match the name of a persistentVolumeClaim in the pod
     */
    private string $name;

    public function __construct(string $devicePath, string $name)
    {
        $this->devicePath = $devicePath;
        $this->name = $name;
    }

    public function getDevicePath(): string
    {
        return $this->devicePath;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDevicePath(string $devicePath): self
    {
        $this->devicePath = $devicePath;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'devicePath' => $this->devicePath,
            'name' => $this->name,
        ];
    }
}
