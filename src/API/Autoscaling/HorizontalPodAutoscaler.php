<?php 

namespace Dealroadshow\K8S\API\Autoscaling;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\HorizontalPodAutoscalerSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * configuration of a horizontal pod autoscaler.
 */
class HorizontalPodAutoscaler implements APIResourceInterface
{
    public const API_VERSION = 'autoscaling/v1';
    public const KIND = 'HorizontalPodAutoscaler';

    /**
     * Standard object metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * behaviour of autoscaler. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status.
     */
    private HorizontalPodAutoscalerSpec $spec;

    public function __construct(HorizontalPodAutoscalerSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): HorizontalPodAutoscalerSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(HorizontalPodAutoscalerSpec $spec): self
    {
        $this->spec = $spec;

        return $this;
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
