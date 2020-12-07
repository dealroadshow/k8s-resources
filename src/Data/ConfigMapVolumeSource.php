<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\KeyToPathList;
use JsonSerializable;

/**
 * Adapts a ConfigMap into a volume.
 *
 * The contents of the target ConfigMap's Data field will be presented in a volume
 * as files using the keys in the Data field as the file names, unless the items
 * element is populated with specific mappings of keys to paths. ConfigMap volumes
 * support ownership management and SELinux relabeling.
 */
class ConfigMapVolumeSource implements JsonSerializable
{
    /**
     * Optional: mode bits to use on created files by default. Must be a value between
     * 0 and 0777. Defaults to 0644. Directories within the path are not affected by
     * this setting. This might be in conflict with other options that affect the file
     * mode, like fsGroup, and the result can be other mode bits set.
     */
    private int|null $defaultMode = null;

    /**
     * If unspecified, each key-value pair in the Data field of the referenced
     * ConfigMap will be projected into the volume as a file whose name is the key and
     * content is the value. If specified, the listed keys will be projected into the
     * specified paths, and unlisted keys will not be present. If a key is specified
     * which is not present in the ConfigMap, the volume setup will error unless it is
     * marked optional. Paths must be relative and may not contain the '..' path or
     * start with '..'.
     */
    private KeyToPathList $items;

    /**
     * Name of the referent. More info:
     * https://kubernetes.io/docs/concepts/overview/working-with-objects/names/#names
     */
    private string|null $name = null;

    /**
     * Specify whether the ConfigMap or its keys must be defined
     */
    private bool|null $optional = null;

    public function __construct()
    {
        $this->items = new KeyToPathList();
    }

    public function getDefaultMode(): int|null
    {
        return $this->defaultMode;
    }

    public function getName(): string|null
    {
        return $this->name;
    }

    public function getOptional(): bool|null
    {
        return $this->optional;
    }

    public function items(): KeyToPathList
    {
        return $this->items;
    }

    public function setDefaultMode(int $defaultMode): self
    {
        $this->defaultMode = $defaultMode;

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setOptional(bool $optional): self
    {
        $this->optional = $optional;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'defaultMode' => $this->defaultMode,
            'items' => $this->items,
            'name' => $this->name,
            'optional' => $this->optional,
        ];
    }
}
