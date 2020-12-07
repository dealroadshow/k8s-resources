<?php 

namespace Dealroadshow\K8S\Data;

use Dealroadshow\K8S\Data\Collection\DownwardAPIVolumeFileList;
use JsonSerializable;

/**
 * Represents downward API info for projecting into a projected volume. Note that
 * this is identical to a downwardAPI volume source without the default mode.
 */
class DownwardAPIProjection implements JsonSerializable
{
    /**
     * Items is a list of DownwardAPIVolume file
     */
    private DownwardAPIVolumeFileList $items;

    public function __construct()
    {
        $this->items = new DownwardAPIVolumeFileList();
    }

    public function items(): DownwardAPIVolumeFileList
    {
        return $this->items;
    }

    public function jsonSerialize(): array
    {
        return [
            'items' => $this->items,
        ];
    }
}
