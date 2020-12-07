<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Represents a host path mapped into a pod. Host path volumes do not support
 * ownership management or SELinux relabeling.
 */
class HostPathVolumeSource implements JsonSerializable
{
    /**
     * Path of the directory on the host. If the path is a symlink, it will follow the
     * link to the real path. More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#hostpath
     */
    private string $path;

    /**
     * Type for HostPath Volume Defaults to "" More info:
     * https://kubernetes.io/docs/concepts/storage/volumes#hostpath
     */
    private string|null $type = null;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getType(): string|null
    {
        return $this->type;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

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
            'path' => $this->path,
            'type' => $this->type,
        ];
    }
}
