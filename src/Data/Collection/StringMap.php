<?php 

namespace Dealroadshow\K8S\Data\Collection;

use JsonSerializable;

class StringMap implements JsonSerializable
{
    /**
     * @var string[]
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
     * @var string[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        foreach ($items as $key => $value) {
            $this->add($key, $value);
        }

        return $this;
    }

    /**
     * @return string[]
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

    public function get(string $name): string
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
