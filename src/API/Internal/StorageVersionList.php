<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Internal;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * A list of StorageVersions.
 */
class StorageVersionList implements APIResourceListInterface
{
    public const API_VERSION = 'internal.apiserver.k8s.io/v1alpha1';
    public const KIND = 'StorageVersionList';

    /**
     * @var StorageVersion[]
     */
    private array $items = [];
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(StorageVersion $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var StorageVersion[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return StorageVersion[]
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
