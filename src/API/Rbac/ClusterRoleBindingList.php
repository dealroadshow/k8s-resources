<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Rbac;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * ClusterRoleBindingList is a collection of ClusterRoleBindings
 */
class ClusterRoleBindingList implements APIResourceListInterface
{
    public const API_VERSION = 'rbac.authorization.k8s.io/v1';
    public const KIND = 'ClusterRoleBindingList';

    /**
     * @var ClusterRoleBinding[]
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

    public function add(ClusterRoleBinding $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ClusterRoleBinding[] $items
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
     * @return ClusterRoleBinding[]
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
