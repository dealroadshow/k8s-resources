<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\NodeSelectorRequirement;
use JsonSerializable;

class NodeSelectorRequirementList implements JsonSerializable
{
    /**
     * @var NodeSelectorRequirement[]
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
     * @var NodeSelectorRequirement[] $items
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
     * @return NodeSelectorRequirement[]
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
