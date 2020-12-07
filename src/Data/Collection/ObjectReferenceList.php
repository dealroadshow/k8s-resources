<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\ObjectReference;
use JsonSerializable;

class ObjectReferenceList implements JsonSerializable
{
    /**
     * @var ObjectReference[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(ObjectReference $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ObjectReference[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return ObjectReference[]
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
