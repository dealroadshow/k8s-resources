<?php 

namespace Dealroadshow\K8S\Data\Collection;

use JsonSerializable;

class StringList implements JsonSerializable
{
    /**
     * @var string[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(string $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var string[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return string[]|array
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
