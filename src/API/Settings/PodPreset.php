<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Settings;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\PodPresetSpec;

/**
 * PodPreset is a policy resource that defines additional runtime requirements for
 * a Pod.
 */
class PodPreset implements APIResourceInterface
{
    public const API_VERSION = 'settings.k8s.io/v1alpha1';
    public const KIND = 'PodPreset';

    private ObjectMeta $metadata;
    private PodPresetSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PodPresetSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): PodPresetSpec
    {
        return $this->spec;
    }

    public function jsonSerialize(): array
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
