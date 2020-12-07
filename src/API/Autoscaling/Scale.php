<?php 

namespace Dealroadshow\K8S\API\Autoscaling;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ScaleSpec;

/**
 * Scale represents a scaling request for a resource.
 */
class Scale implements APIResourceInterface
{
    const API_VERSION = 'autoscaling/v1';
    const KIND = 'Scale';

    /**
     * Standard object metadata; More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata.
     */
    private ObjectMeta $metadata;

    /**
     * defines the behavior of the scale. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status.
     */
    private ScaleSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ScaleSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): ScaleSpec
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
