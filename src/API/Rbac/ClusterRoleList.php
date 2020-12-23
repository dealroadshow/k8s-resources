<?php 

namespace Dealroadshow\K8S\API\Rbac;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * ClusterRoleList is a collection of ClusterRoles
 */
class ClusterRoleList implements APIResourceListInterface
{
    const API_VERSION = 'rbac.authorization.k8s.io/v1';
    const KIND = 'ClusterRoleList';

    /**
     * @var ClusterRole[]
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

    public function add(ClusterRole $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ClusterRole[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return ClusterRole[]
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
