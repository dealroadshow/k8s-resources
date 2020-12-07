<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\PodAffinityTerm;
use JsonSerializable;

class PodAffinityTermList implements JsonSerializable
{
    /**
     * @var PodAffinityTerm[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(PodAffinityTerm $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var PodAffinityTerm[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return PodAffinityTerm[]
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
