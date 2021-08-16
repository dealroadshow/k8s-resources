<?php 

namespace Dealroadshow\K8S\API\Flowcontrol;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\PriorityLevelConfigurationSpec;

/**
 * PriorityLevelConfiguration represents the configuration of a priority level.
 */
class PriorityLevelConfiguration implements APIResourceInterface
{
    const API_VERSION = 'flowcontrol.apiserver.k8s.io/v1beta1';
    const KIND = 'PriorityLevelConfiguration';

    /**
     * `metadata` is the standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * `spec` is the specification of the desired behavior of a "request-priority".
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private PriorityLevelConfigurationSpec $spec;

    public function __construct(PriorityLevelConfigurationSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): PriorityLevelConfigurationSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(PriorityLevelConfigurationSpec $spec): self
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
