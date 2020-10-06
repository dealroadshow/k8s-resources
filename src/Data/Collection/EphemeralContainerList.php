<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\EphemeralContainer;
use JsonSerializable;

class EphemeralContainerList implements JsonSerializable
{
    /**
     * @var EphemeralContainer[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(EphemeralContainer $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var EphemeralContainer[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return EphemeralContainer[]|array
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
