<?php 

namespace Dealroadshow\K8S\API\Flowcontrol;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * PriorityLevelConfigurationList is a list of PriorityLevelConfiguration objects.
 */
class PriorityLevelConfigurationList implements APIResourceListInterface
{
    const API_VERSION = 'flowcontrol.apiserver.k8s.io/v1alpha1';
    const KIND = 'PriorityLevelConfigurationList';

    /**
     * @var PriorityLevelConfiguration[]
     */
    private array $items = [];

    /**
     * `metadata` is the standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(PriorityLevelConfiguration $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var PriorityLevelConfiguration[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return PriorityLevelConfiguration[]
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