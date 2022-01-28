<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Admissionregistration;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\Collection\ValidatingWebhookList;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * ValidatingWebhookConfiguration describes the configuration of and admission
 * webhook that accept or reject and object without changing it.
 */
class ValidatingWebhookConfiguration implements APIResourceInterface
{
    public const API_VERSION = 'admissionregistration.k8s.io/v1';
    public const KIND = 'ValidatingWebhookConfiguration';

    /**
     * Standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * Webhooks is a list of webhooks and the affected resources and operations.
     */
    private ValidatingWebhookList $webhooks;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->webhooks = new ValidatingWebhookList();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function webhooks(): ValidatingWebhookList
    {
        return $this->webhooks;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'webhooks' => $this->webhooks,
        ];
    }
}
