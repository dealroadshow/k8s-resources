<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\AllowedFlexVolume;
use JsonSerializable;

class AllowedFlexVolumeList implements JsonSerializable
{
    /**
     * @var AllowedFlexVolume[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(AllowedFlexVolume $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var AllowedFlexVolume[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        foreach ($items as $value) {
            $this->add($value);
        }

        return $this;
    }

    /**
     * @return AllowedFlexVolume[]
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

    public function count(): int
    {
        return count($this->items);
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}
