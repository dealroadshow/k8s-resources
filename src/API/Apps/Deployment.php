<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Apps;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\DeploymentSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * Deployment enables declarative updates for Pods and ReplicaSets.
 */
class Deployment implements APIResourceInterface
{
    public const API_VERSION = 'apps/v1';
    public const KIND = 'Deployment';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior of the Deployment.
     */
    private DeploymentSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new DeploymentSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): DeploymentSpec
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
