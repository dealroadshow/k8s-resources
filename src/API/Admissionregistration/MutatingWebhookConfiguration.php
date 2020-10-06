<?php 

namespace Dealroadshow\K8S\API\Admissionregistration;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\MutatingWebhookList;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * MutatingWebhookConfiguration describes the configuration of and admission
 * webhook that accept or reject and may change the object.
 */
class MutatingWebhookConfiguration implements APIResourceInterface
{
    const API_VERSION = 'admissionregistration.k8s.io/v1';
    const KIND = 'MutatingWebhookConfiguration';

    /**
     * Standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * Webhooks is a list of webhooks and the affected resources and operations.
     */
    private MutatingWebhookList $webhooks;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->webhooks = new MutatingWebhookList();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function webhooks(): MutatingWebhookList
    {
        return $this->webhooks;
    }

    public function jsonSerialize()
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'webhooks' => $this->webhooks,
        ];
    }
}
