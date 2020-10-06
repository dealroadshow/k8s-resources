<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\EnvFromSource;
use JsonSerializable;

class EnvFromSourceList implements JsonSerializable
{
    /**
     * @var EnvFromSource[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(EnvFromSource $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var EnvFromSource[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return EnvFromSource[]|array
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
