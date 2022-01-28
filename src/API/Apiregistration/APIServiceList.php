<?php 

namespace Dealroadshow\K8S\API\Apiregistration;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * APIServiceList is a list of APIService objects.
 */
class APIServiceList implements APIResourceListInterface
{
    public const API_VERSION = 'apiregistration.k8s.io/v1';
    public const KIND = 'APIServiceList';

    /**
     * @var APIService[]
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
     * @var APIService[] $items
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
     * @return APIService[]
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
