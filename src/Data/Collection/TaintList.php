<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\Taint;
use JsonSerializable;

class TaintList implements JsonSerializable
{
    /**
     * @var Taint[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(Taint $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var Taint[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return Taint[]
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
