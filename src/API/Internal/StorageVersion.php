<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Internal;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\StorageVersionSpec;

/**
 * Storage version of a specific resource.
 */
class StorageVersion implements APIResourceInterface
{
    public const API_VERSION = 'internal.apiserver.k8s.io/v1alpha1';
    public const KIND = 'StorageVersion';

    /**
     * The name is <group>.<resource>.
     */
    private ObjectMeta $metadata;

    /**
     * Spec is an empty spec. It is here to comply with Kubernetes API style.
     */
    private StorageVersionSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new StorageVersionSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): StorageVersionSpec
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
