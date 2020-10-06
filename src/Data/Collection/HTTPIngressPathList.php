<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\HTTPIngressPath;
use JsonSerializable;

class HTTPIngressPathList implements JsonSerializable
{
    /**
     * @var HTTPIngressPath[]|array
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
     * @var HTTPIngressPath[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return HTTPIngressPath[]|array
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
