<?php 

namespace Dealroadshow\K8S\API\Apiregistration;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * APIServiceList is a list of APIService objects.
 */
class APIServiceList implements APIResourceListInterface
{
    const API_VERSION = 'apiregistration.k8s.io/v1';
    const KIND = 'APIServiceList';

    /**
     * @var APIService[]|array
     */
    private array $items = [];
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(APIService $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var APIService[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return APIService[]|array
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
