<?php 

namespace Dealroadshow\K8S\API\Networking;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * NetworkPolicyList is a list of NetworkPolicy objects.
 */
class NetworkPolicyList implements APIResourceListInterface
{
    const API_VERSION = 'networking.k8s.io/v1';
    const KIND = 'NetworkPolicyList';

    /**
     * @var NetworkPolicy[]
     */
    private array $items = [];

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(NetworkPolicy $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var NetworkPolicy[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return NetworkPolicy[]
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
