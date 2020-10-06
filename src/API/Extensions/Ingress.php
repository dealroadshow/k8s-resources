<?php 

namespace Dealroadshow\K8S\API\Extensions;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\IngressSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * Ingress is a collection of rules that allow inbound connections to reach the
 * endpoints defined by a backend. An Ingress can be configured to give services
 * externally-reachable urls, load balance traffic, terminate SSL, offer name based
 * virtual hosting etc. DEPRECATED - This group version of Ingress is deprecated by
 * networking.k8s.io/v1beta1 Ingress. See the release notes for more information.
 */
class Ingress implements APIResourceInterface
{
    const API_VERSION = 'extensions/v1beta1';
    const KIND = 'Ingress';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec is the desired state of the Ingress. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private IngressSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new IngressSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): IngressSpec
    {
        return $this->spec;
    }

    public function jsonSerialize()
    {
        return [
            'apiVersion' => self::API_VERSION,
            'kind' => self::KIND,
            'metadata' => $this->metadata,
            'spec' => $this->spec,
        ];
    }
}
