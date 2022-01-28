<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Policy;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\PodDisruptionBudgetSpec;

/**
 * PodDisruptionBudget is an object to define the max disruption that can be caused
 * to a collection of pods
 */
class PodDisruptionBudget implements APIResourceInterface
{
    public const API_VERSION = 'policy/v1';
    public const KIND = 'PodDisruptionBudget';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the PodDisruptionBudget.
     */
    private PodDisruptionBudgetSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new PodDisruptionBudgetSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): PodDisruptionBudgetSpec
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
