<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\NodeSelectorTerm;
use JsonSerializable;

class NodeSelectorTermList implements JsonSerializable
{
    /**
     * @var NodeSelectorTerm[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(NodeSelectorTerm $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var NodeSelectorTerm[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return NodeSelectorTerm[]
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
