<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Local represents directly-attached storage with node affinity (Beta feature)
 */
class LocalVolumeSource implements JsonSerializable
{
    /**
     * fsType is the filesystem type to mount. It applies only when the Path is a block
     * device. Must be a filesystem type supported by the host operating system. Ex.
     * "ext4", "xfs", "ntfs". The default value is to auto-select a filesystem if
     * unspecified.
     */
    private string|null $fsType = null;

    /**
     * path of the full path to the volume on the node. It can be either a directory or
     * block device (disk, partition, ...).
     */
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getFsType(): string|null
    {
        return $this->fsType;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setFsType(string $fsType): self
    {
        $this->fsType = $fsType;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'fsType' => $this->fsType,
            'path' => $this->path,
        ];
    }
}
