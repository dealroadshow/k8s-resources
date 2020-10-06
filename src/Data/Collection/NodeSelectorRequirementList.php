<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\NodeSelectorRequirement;
use JsonSerializable;

class NodeSelectorRequirementList implements JsonSerializable
{
    /**
     * @var NodeSelectorRequirement[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(NodeSelectorRequirement $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var NodeSelectorRequirement[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return NodeSelectorRequirement[]|array
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
