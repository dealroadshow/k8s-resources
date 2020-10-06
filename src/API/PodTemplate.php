<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\PodTemplateSpec;

/**
 * PodTemplate describes a template for creating copies of a predefined pod.
 */
class PodTemplate implements APIResourceInterface
{
    const API_VERSION = 'v1';
    const KIND = 'PodTemplate';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Template defines the pods that will be created from this pod template.
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private PodTemplateSpec $template;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->template = new PodTemplateSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function template(): PodTemplateSpec
    {
        return $this->template;
    }

    public function jsonSerialize()
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'template' => $this->template,
        ];
    }
}
