<?php 

namespace Dealroadshow\K8S\API\Scheduling;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * PriorityClassList is a collection of priority classes.
 */
class PriorityClassList implements APIResourceListInterface
{
    public const API_VERSION = 'scheduling.k8s.io/v1';
    public const KIND = 'PriorityClassList';

    /**
     * @var PriorityClass[]
     */
    private array $items = [];

    /**
     * Standard list metadata More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(PriorityClass $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var PriorityClass[] $items
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
     * @return PriorityClass[]
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
