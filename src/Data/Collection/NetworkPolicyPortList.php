<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\NetworkPolicyPort;
use JsonSerializable;

class NetworkPolicyPortList implements JsonSerializable
{
    /**
     * @var NetworkPolicyPort[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(NetworkPolicyPort $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var NetworkPolicyPort[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return NetworkPolicyPort[]
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
