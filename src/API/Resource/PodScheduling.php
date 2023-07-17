<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Resource;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\PodSchedulingSpec;

/**
 * PodScheduling objects hold information that is needed to schedule a Pod with
 * ResourceClaims that use "WaitForFirstConsumer" allocation mode.
 *
 * This is an alpha type and requires enabling the DynamicResourceAllocation
 * feature gate.
 */
class PodScheduling implements APIResourceInterface
{
    public const API_VERSION = 'resource.k8s.io/v1alpha1';
    public const KIND = 'PodScheduling';

    /**
     * Standard object metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec describes where resources for the Pod are needed.
     */
    private PodSchedulingSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PodSchedulingSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): PodSchedulingSpec
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
