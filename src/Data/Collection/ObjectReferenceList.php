<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\ObjectReference;
use JsonSerializable;

class ObjectReferenceList implements JsonSerializable
{
    /**
     * @var ObjectReference[]|array
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
     * @var ObjectReference[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return ObjectReference[]|array
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
