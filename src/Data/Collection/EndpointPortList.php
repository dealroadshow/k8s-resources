<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\EndpointPort;
use JsonSerializable;

class EndpointPortList implements JsonSerializable
{
    /**
     * @var EndpointPort[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(EndpointPort $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var EndpointPort[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return EndpointPort[]
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
