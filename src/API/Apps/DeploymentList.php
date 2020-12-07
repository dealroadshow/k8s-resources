<?php 

namespace Dealroadshow\K8S\API\Apps;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * DeploymentList is a list of Deployments.
 */
class DeploymentList implements APIResourceListInterface
{
    const API_VERSION = 'apps/v1';
    const KIND = 'DeploymentList';

    /**
     * @var Deployment[]
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

    public function add(Deployment $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var Deployment[] $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return Deployment[]
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
