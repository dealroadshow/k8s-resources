<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\LocalObjectReference;
use JsonSerializable;

class LocalObjectReferenceList implements JsonSerializable
{
    /**
     * @var LocalObjectReference[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(LocalObjectReference $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var LocalObjectReference[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return LocalObjectReference[]
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
