<?php 

namespace Dealroadshow\K8S\Data\Collection;

use Dealroadshow\K8S\Data\ValidatingWebhook;
use JsonSerializable;

class ValidatingWebhookList implements JsonSerializable
{
    /**
     * @var ValidatingWebhook[]
     */
    private array $items = [];

    public function __construct()
    {
        $this->clear();
    }

    public function add(ValidatingWebhook $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ValidatingWebhook[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return ValidatingWebhook[]
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
