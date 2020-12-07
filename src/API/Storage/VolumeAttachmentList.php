<?php 

namespace Dealroadshow\K8S\API\Storage;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * VolumeAttachmentList is a collection of VolumeAttachment objects.
 */
class VolumeAttachmentList implements APIResourceListInterface
{
    const API_VERSION = 'storage.k8s.io/v1';
    const KIND = 'VolumeAttachmentList';

    /**
     * @var VolumeAttachment[]
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

    public function add(VolumeAttachment $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var VolumeAttachment[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return VolumeAttachment[]
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
