<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\PreferredSchedulingTerm;
use JsonSerializable;

class PreferredSchedulingTermList implements JsonSerializable
{
    /**
     * @var PreferredSchedulingTerm[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(PreferredSchedulingTerm $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var PreferredSchedulingTerm[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return PreferredSchedulingTerm[]
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
