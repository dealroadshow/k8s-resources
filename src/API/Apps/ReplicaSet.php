<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Apps;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ReplicaSetSpec;

/**
 * ReplicaSet ensures that a specified number of pod replicas are running at any
 * given time.
 */
class ReplicaSet implements APIResourceInterface
{
    public const API_VERSION = 'apps/v1';
    public const KIND = 'ReplicaSet';

    /**
     * If the Labels of a ReplicaSet are empty, they are defaulted to be the same as
     * the Pod(s) that the ReplicaSet manages. Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines the specification of the desired behavior of the ReplicaSet. More
     * info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private ReplicaSetSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ReplicaSetSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): ReplicaSetSpec
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
