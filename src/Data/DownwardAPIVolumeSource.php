<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\DownwardAPIVolumeFileList;
use JsonSerializable;

/**
 * DownwardAPIVolumeSource represents a volume containing downward API info.
 * Downward API volumes support ownership management and SELinux relabeling.
 */
class DownwardAPIVolumeSource implements JsonSerializable
{
    /**
     * Optional: mode bits to use on created files by default. Must be a value between
     * 0 and 0777. Defaults to 0644. Directories within the path are not affected by
     * this setting. This might be in conflict with other options that affect the file
     * mode, like fsGroup, and the result can be other mode bits set.
     */
    private int|null $defaultMode = null;

    /**
     * Items is a list of downward API volume file
     */
    private DownwardAPIVolumeFileList $items;

    public function __construct()
    {
        $this->items = new DownwardAPIVolumeFileList();
    }

    public function getDefaultMode(): int|null
    {
        return $this->defaultMode;
    }

    public function items(): DownwardAPIVolumeFileList
    {
        return $this->items;
    }

    public function setDefaultMode(int $defaultMode): self
    {
        $this->defaultMode = $defaultMode;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'defaultMode' => $this->defaultMode,
            'items' => $this->items,
        ];
    }
}
