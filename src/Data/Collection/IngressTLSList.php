<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\IngressTLS;
use JsonSerializable;

class IngressTLSList implements JsonSerializable
{
    /**
     * @var IngressTLS[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(IngressTLS $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var IngressTLS[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return IngressTLS[]
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
