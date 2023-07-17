<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Resource;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * ResourceClassList is a collection of classes.
 */
class ResourceClassList implements APIResourceListInterface
{
    public const API_VERSION = 'resource.k8s.io/v1alpha1';
    public const KIND = 'ResourceClassList';

    /**
     * @var ResourceClass[]
     */
    private array $items = [];

    /**
     * Standard list metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(ResourceClass $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ResourceClass[] $items
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
     * @return ResourceClass[]
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
