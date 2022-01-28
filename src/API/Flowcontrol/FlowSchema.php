<?php 

namespace Dealroadshow\K8S\API\Flowcontrol;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\FlowSchemaSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * FlowSchema defines the schema of a group of flows. Note that a flow is made up
 * of a set of inbound API requests with similar attributes and is identified by a
 * pair of strings: the name of the FlowSchema and a "flow distinguisher".
 */
class FlowSchema implements APIResourceInterface
{
    public const API_VERSION = 'flowcontrol.apiserver.k8s.io/v1alpha1';
    public const KIND = 'FlowSchema';

    /**
     * `metadata` is the standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * `spec` is the specification of the desired behavior of a FlowSchema. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private FlowSchemaSpec $spec;

    public function __construct(FlowSchemaSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): FlowSchemaSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(FlowSchemaSpec $spec): self
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
