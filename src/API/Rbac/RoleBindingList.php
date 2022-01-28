<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Rbac;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * RoleBindingList is a collection of RoleBindings
 */
class RoleBindingList implements APIResourceListInterface
{
    public const API_VERSION = 'rbac.authorization.k8s.io/v1';
    public const KIND = 'RoleBindingList';

    /**
     * @var RoleBinding[]
     */
    private array $items = [];

    /**
     * Standard object's metadata.
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(RoleBinding $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var RoleBinding[] $items
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
     * @return RoleBinding[]
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

    public function metadata(): ListMeta
    {
        return $this->metadata;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'items' => $this->items,
            'metadata' => $this->metadata,
        ];
    }
}
