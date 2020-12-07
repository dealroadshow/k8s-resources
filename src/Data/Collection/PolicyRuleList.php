<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\PolicyRule;
use JsonSerializable;

class PolicyRuleList implements JsonSerializable
{
    /**
     * @var PolicyRule[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(PolicyRule $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var PolicyRule[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return PolicyRule[]
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
