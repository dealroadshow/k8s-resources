<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\ForZone;
use JsonSerializable;

class ForZoneList implements JsonSerializable
{
    /**
     * @var ForZone[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(ForZone $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ForZone[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return ForZone[]
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

    public function count(): int
    {
        return count($this->items);
    }

    public function jsonSerialize(): array
    {
        return $this->items;
    }
}
