<?php 

namespace Dealroadshow\K8S\API\Flowcontrol;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * FlowSchemaList is a list of FlowSchema objects.
 */
class FlowSchemaList implements APIResourceListInterface
{
    const API_VERSION = 'flowcontrol.apiserver.k8s.io/v1alpha1';
    const KIND = 'FlowSchemaList';

    /**
     * @var FlowSchema[]
     */
    private array $items = [];

    /**
     * `metadata` is the standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(FlowSchema $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var FlowSchema[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return FlowSchema[]
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
