<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\NamespaceSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * Namespace provides a scope for Names. Use of multiple namespaces is optional.
 */
class KubernetesNamespace implements APIResourceInterface
{
    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines the behavior of the Namespace. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private NamespaceSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new NamespaceSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): NamespaceSpec
    {
        return $this->spec;
    }

    public function jsonSerialize()
    {
        return [
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
