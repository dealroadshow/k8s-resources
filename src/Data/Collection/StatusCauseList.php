<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\StatusCause;
use JsonSerializable;

class StatusCauseList implements JsonSerializable
{
    /**
     * @var StatusCause[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(StatusCause $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var StatusCause[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return StatusCause[]
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
