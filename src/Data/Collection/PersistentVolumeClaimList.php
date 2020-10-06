<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\API\PersistentVolumeClaim;
use JsonSerializable;

class PersistentVolumeClaimList implements JsonSerializable
{
    /**
     * @var PersistentVolumeClaim[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(PersistentVolumeClaim $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var PersistentVolumeClaim[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return PersistentVolumeClaim[]|array
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
