<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\NetworkPolicyIngressRule;
use JsonSerializable;

class NetworkPolicyIngressRuleList implements JsonSerializable
{
    /**
     * @var NetworkPolicyIngressRule[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(NetworkPolicyIngressRule $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var NetworkPolicyIngressRule[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return NetworkPolicyIngressRule[]|array
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
