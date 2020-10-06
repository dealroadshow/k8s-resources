<?php 

namespace Dealroadshow\K8S\API\Apiextensions;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * CustomResourceDefinitionList is a list of CustomResourceDefinition objects.
 */
class CustomResourceDefinitionList implements APIResourceListInterface
{
    const API_VERSION = 'apiextensions.k8s.io/v1';
    const KIND = 'CustomResourceDefinitionList';

    /**
     * @var CustomResourceDefinition[]|array
     */
    private array $items = [];
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(CustomResourceDefinition $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var CustomResourceDefinition[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return CustomResourceDefinition[]|array
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

    public function metadata(): ListMeta
    {
        return $this->metadata;
    }

    public function jsonSerialize()
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'items' => $this->items,
            'metadata' => $this->metadata,
        ];
    }
}
