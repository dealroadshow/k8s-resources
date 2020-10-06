<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\IngressRule;
use JsonSerializable;

class IngressRuleList implements JsonSerializable
{
    /**
     * @var IngressRule[]|array
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(IngressRule $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var IngressRule[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return IngressRule[]|array
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
