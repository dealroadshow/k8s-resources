<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Discovery;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * EndpointSliceList represents a list of endpoint slices
 */
class EndpointSliceList implements APIResourceListInterface
{
    public const API_VERSION = 'discovery.k8s.io/v1beta1';
    public const KIND = 'EndpointSliceList';

    /**
     * @var EndpointSlice[]
     */
    private array $items = [];

    /**
     * Standard list metadata.
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(EndpointSlice $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var EndpointSlice[] $items
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
     * @return EndpointSlice[]
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
