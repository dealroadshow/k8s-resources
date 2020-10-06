<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Local represents directly-attached storage with node affinity (Beta feature)
 */
class LocalVolumeSource implements JsonSerializable
{
    /**
     * Filesystem type to mount. It applies only when the Path is a block device. Must
     * be a filesystem type supported by the host operating system. Ex. "ext4", "xfs",
     * "ntfs". The default value is to auto-select a fileystem if unspecified.
     *
     * @var string|null
     */
    private ?string $fsType = null;

    /**
     * The full path to the volume on the node. It can be either a directory or block
     * device (disk, partition, ...).
     */
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @return string|null
     */
    public function getFsType(): ?string
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

    public function jsonSerialize()
    {
        return [
            'fsType' => $this->fsType,
            'path' => $this->path,
        ];
    }
}
