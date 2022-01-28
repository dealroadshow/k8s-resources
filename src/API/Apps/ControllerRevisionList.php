<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Apps;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * ControllerRevisionList is a resource containing a list of ControllerRevision
 * objects.
 */
class ControllerRevisionList implements APIResourceListInterface
{
    public const API_VERSION = 'apps/v1';
    public const KIND = 'ControllerRevisionList';

    /**
     * @var ControllerRevision[]
     */
    private array $items = [];

    /**
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(ControllerRevision $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var ControllerRevision[] $items
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
     * @return ControllerRevision[]
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
