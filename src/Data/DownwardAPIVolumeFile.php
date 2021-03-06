<?php 

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * DownwardAPIVolumeFile represents information to create the file containing the
 * pod field
 */
class DownwardAPIVolumeFile implements JsonSerializable
{
    /**
     * Required: Selects a field of the pod: only annotations, labels, name and
     * namespace are supported.
     */
    private ObjectFieldSelector|null $fieldRef = null;

    /**
     * Optional: mode bits to use on this file, must be a value between 0 and 0777. If
     * not specified, the volume defaultMode will be used. This might be in conflict
     * with other options that affect the file mode, like fsGroup, and the result can
     * be other mode bits set.
     */
    private int|null $mode = null;

    /**
     * Required: Path is  the relative path name of the file to be created. Must not be
     * absolute or contain the '..' path. Must be utf-8 encoded. The first item of the
     * relative path must not start with '..'
     */
    private string $path;

    /**
     * Selects a resource of the container: only resources limits and requests
     * (limits.cpu, limits.memory, requests.cpu and requests.memory) are currently
     * supported.
     */
    private ResourceFieldSelector|null $resourceFieldRef = null;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function getFieldRef(): ObjectFieldSelector|null
    {
        return $this->fieldRef;
    }

    public function getMode(): int|null
    {
        return $this->mode;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getResourceFieldRef(): ResourceFieldSelector|null
    {
        return $this->resourceFieldRef;
    }

    public function setFieldRef(ObjectFieldSelector $fieldRef): self
    {
        $this->fieldRef = $fieldRef;

        return $this;
    }

    public function setMode(int $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setResourceFieldRef(ResourceFieldSelector $resourceFieldRef): self
    {
        $this->resourceFieldRef = $resourceFieldRef;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'fieldRef' => $this->fieldRef,
            'mode' => $this->mode,
            'path' => $this->path,
            'resourceFieldRef' => $this->resourceFieldRef,
        ];
    }
}
