<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\HTTPIngressPath;
use JsonSerializable;

class HTTPIngressPathList implements JsonSerializable
{
    /**
     * @var HTTPIngressPath[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(HTTPIngressPath $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var HTTPIngressPath[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return HTTPIngressPath[]
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
