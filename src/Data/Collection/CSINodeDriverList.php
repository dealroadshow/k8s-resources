<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\CSINodeDriver;
use JsonSerializable;

class CSINodeDriverList implements JsonSerializable
{
    /**
     * @var CSINodeDriver[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(CSINodeDriver $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var CSINodeDriver[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return CSINodeDriver[]
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
