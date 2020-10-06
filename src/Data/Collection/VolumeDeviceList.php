<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\VolumeDevice;
use JsonSerializable;

class VolumeDeviceList implements JsonSerializable
{
    /**
     * @var VolumeDevice[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(VolumeDevice $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var VolumeDevice[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return VolumeDevice[]|array
     */
    public function all(): array
    {
        return $this->items;
    }

    public function clear(): self
    {
        $this->items = [];

        return $this;
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}
