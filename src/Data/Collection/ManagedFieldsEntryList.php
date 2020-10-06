<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\ManagedFieldsEntry;
use JsonSerializable;

class ManagedFieldsEntryList implements JsonSerializable
{
    /**
     * @var ManagedFieldsEntry[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(ManagedFieldsEntry $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ManagedFieldsEntry[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return ManagedFieldsEntry[]|array
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
