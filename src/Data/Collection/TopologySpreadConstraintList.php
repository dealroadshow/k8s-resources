<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\TopologySpreadConstraint;
use JsonSerializable;

class TopologySpreadConstraintList implements JsonSerializable
{
    /**
     * @var TopologySpreadConstraint[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(TopologySpreadConstraint $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var TopologySpreadConstraint[] $items
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
     * @return TopologySpreadConstraint[]
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
