<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\PodDNSConfigOption;
use JsonSerializable;

class PodDNSConfigOptionList implements JsonSerializable
{
    /**
     * @var PodDNSConfigOption[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(PodDNSConfigOption $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var PodDNSConfigOption[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return PodDNSConfigOption[]
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
