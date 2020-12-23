<?php 

namespace Dealroadshow\K8S\API\Extensions;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * PodSecurityPolicyList is a list of PodSecurityPolicy objects. Deprecated: use
 * PodSecurityPolicyList from policy API Group instead.
 */
class PodSecurityPolicyList implements APIResourceListInterface
{
    const API_VERSION = 'extensions/v1beta1';
    const KIND = 'PodSecurityPolicyList';

    /**
     * @var PodSecurityPolicy[]
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

    public function add(PodSecurityPolicy $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var PodSecurityPolicy[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return PodSecurityPolicy[]
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
