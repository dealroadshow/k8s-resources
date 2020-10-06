<?php 

namespace Dealroadshow\K8S\API\Admissionregistration;

use Dealroadshow\K8S\APIResourceListInterface;
use Dealroadshow\K8S\Data\ListMeta;

/**
 * MutatingWebhookConfigurationList is a list of MutatingWebhookConfiguration.
 */
class MutatingWebhookConfigurationList implements APIResourceListInterface
{
    const API_VERSION = 'admissionregistration.k8s.io/v1';
    const KIND = 'MutatingWebhookConfigurationList';

    /**
     * @var MutatingWebhookConfiguration[]|array
     */
    private array $items = [];

    /**
     * Standard list metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#types-kinds
     */
    private ListMeta $metadata;

    public function __construct()
    {
        $this->items = [];
        $this->metadata = new ListMeta();
    }

    public function add(MutatingWebhookConfiguration $value): self
    {
        $this->items[] = $value;

        return $this;
    }

    /**
     * @var MutatingWebhookConfiguration[]|array $items
     *
     * @return self
     */
    public function addAll(array $items): self
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    /**
     * @return MutatingWebhookConfiguration[]|array
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

    public function jsonSerialize()
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'items' => $this->items,
            'metadata' => $this->metadata,
        ];
    }
}
