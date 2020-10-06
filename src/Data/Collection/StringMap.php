<?php 

namespace Dealroadshow\K8S\Data\Collection;

use JsonSerializable;

class StringMap implements JsonSerializable
{
    /**
     * @var array<string, string>|string[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(string $name, string $value): self
    {
        $this->items[$name] = $value;

        return $this;
    }

    /**
     * @var array<string, string>|string[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return array<string, string>|string[]
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

    public function get(string $name): string
    {
        return $this->items[$name];
    }

    public function has(string $name): bool
    {
        return \array_key_exists($name, $this->items);
    }

    public function remove(string $name): self
    {
        unset($this->items[$name]);

        return $this;
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}
