<?php 

namespace Dealroadshow\K8S\API\Policy;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * PodDisruptionBudgetList is a collection of PodDisruptionBudgets.
 */
class PodDisruptionBudgetList implements APIResourceListInterface
{
    const API_VERSION = 'policy/v1';
    const KIND = 'PodDisruptionBudgetList';

    /**
     * @var PodDisruptionBudget[]
     */
    private array $items = [];

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(PodDisruptionBudget $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var PodDisruptionBudget[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return PodDisruptionBudget[]
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
