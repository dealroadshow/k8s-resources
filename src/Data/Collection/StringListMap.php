<?php 

namespace Dealroadshow\K8S\Data\Collection;

use JsonSerializable;

class StringListMap implements JsonSerializable
{
    /**
     * @var StringList[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(string $name, StringList $value): self
    {
        $this->items[$name] = $value;

        return $this;
    }

    /**
     * @var StringList[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return StringList[]
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

    public function get(string $name): StringList
    {
        return $this->items[$name];
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->items);
    }

    public function remove(string $name): self
    {
        unset($this->items[$name]);

        return $this;
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}
