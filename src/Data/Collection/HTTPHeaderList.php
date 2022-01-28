<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\HTTPHeader;
use JsonSerializable;

class HTTPHeaderList implements JsonSerializable
{
    /**
     * @var HTTPHeader[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(HTTPHeader $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var HTTPHeader[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        foreach ($items as $value) {
            $this->add($value);
        }

        return $this;
    }

    /**
     * @return HTTPHeader[]
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
