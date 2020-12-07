<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\VolumeMount;
use JsonSerializable;

class VolumeMountList implements JsonSerializable
{
    /**
     * @var VolumeMount[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(VolumeMount $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var VolumeMount[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return VolumeMount[]
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

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}
