<?php 

namespace Dealroadshow\K8S\Data\Collection;

use JsonSerializable;

class IntList implements JsonSerializable
{
    /**
     * @var int[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(int $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var int[] $items
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
     * @return int[]
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
