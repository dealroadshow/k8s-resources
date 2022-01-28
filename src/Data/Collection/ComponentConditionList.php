<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\ComponentCondition;
use JsonSerializable;

class ComponentConditionList implements JsonSerializable
{
    /**
     * @var ComponentCondition[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(ComponentCondition $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ComponentCondition[] $items
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
     * @return ComponentCondition[]
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
