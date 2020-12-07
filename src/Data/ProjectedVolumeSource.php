<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\VolumeProjectionList;
use JsonSerializable;

/**
 * Represents a projected volume source
 */
class ProjectedVolumeSource implements JsonSerializable
{
    /**
     * Mode bits to use on created files by default. Must be a value between 0 and
     * 0777. Directories within the path are not affected by this setting. This might
     * be in conflict with other options that affect the file mode, like fsGroup, and
     * the result can be other mode bits set.
     */
    private int|null $defaultMode = null;

    /**
     * list of volume projections
     */
    private VolumeProjectionList $sources;

    public function __construct()
    {
        $this->sources = new VolumeProjectionList();
    }

    public function getDefaultMode(): int|null
    {
        return $this->defaultMode;
    }

    public function setDefaultMode(int $defaultMode): self
    {
        $this->defaultMode = $defaultMode;

        return $this;
    }

    public function sources(): VolumeProjectionList
    {
        return $this->sources;
    }

    public function jsonSerialize(): array
    {
        return [
            'defaultMode' => $this->defaultMode,
            'sources' => $this->sources,
        ];
    }
}
