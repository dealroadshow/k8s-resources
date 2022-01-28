<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data;

use JsonSerializable;

/**
 * Maps a string key to a path within a volume.
 */
class KeyToPath implements JsonSerializable
{
    /**
     * The key to project.
     */
    private string $key;

    /**
     * Optional: mode bits used to set permissions on this file. Must be an octal value
     * between 0000 and 0777 or a decimal value between 0 and 511. YAML accepts both
     * octal and decimal values, JSON requires decimal values for mode bits. If not
     * specified, the volume defaultMode will be used. This might be in conflict with
     * other options that affect the file mode, like fsGroup, and the result can be
     * other mode bits set.
     */
    private int|null $mode = null;

    /**
     * The relative path of the file to map the key to. May not be an absolute path.
     * May not contain the path element '..'. May not start with the string '..'.
     */
    private string $path;

    public function __construct(string $key, string $path)
    {
        $this->key = $key;
        $this->path = $path;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getMode(): int|null
    {
        return $this->mode;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setKey(string $key): self
    {
        $this->key = $key;

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

    public function jsonSerialize(): array
    {
        return [
            'key' => $this->key,
            'mode' => $this->mode,
            'path' => $this->path,
        ];
    }
}
