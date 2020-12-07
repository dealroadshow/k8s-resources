<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\LimitRangeItem;
use JsonSerializable;

class LimitRangeItemList implements JsonSerializable
{
    /**
     * @var LimitRangeItem[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(LimitRangeItem $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var LimitRangeItem[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return LimitRangeItem[]
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
