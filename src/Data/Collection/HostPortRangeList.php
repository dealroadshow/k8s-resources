<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\HostPortRange;
use JsonSerializable;

class HostPortRangeList implements JsonSerializable
{
    /**
     * @var HostPortRange[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(HostPortRange $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var HostPortRange[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return HostPortRange[]|array
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
