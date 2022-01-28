<?php 

namespace Dealroadshow\K8S\API\Networking;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * IngressClassList is a collection of IngressClasses.
 */
class IngressClassList implements APIResourceListInterface
{
    public const API_VERSION = 'networking.k8s.io/v1';
    public const KIND = 'IngressClassList';

    /**
     * @var IngressClass[]
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

    public function add(IngressClass $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var IngressClass[] $items
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
     * @return IngressClass[]
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
