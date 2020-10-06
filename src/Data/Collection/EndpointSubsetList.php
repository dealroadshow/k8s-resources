<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\EndpointSubset;
use JsonSerializable;

class EndpointSubsetList implements JsonSerializable
{
    /**
     * @var EndpointSubset[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(EndpointSubset $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var EndpointSubset[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return EndpointSubset[]|array
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
