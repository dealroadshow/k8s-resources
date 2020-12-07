<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\NetworkPolicyPeer;
use JsonSerializable;

class NetworkPolicyPeerList implements JsonSerializable
{
    /**
     * @var NetworkPolicyPeer[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(NetworkPolicyPeer $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var NetworkPolicyPeer[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return NetworkPolicyPeer[]
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
