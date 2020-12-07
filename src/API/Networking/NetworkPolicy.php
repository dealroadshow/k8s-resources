<?php 

namespace Dealroadshow\K8S\API\Networking;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\NetworkPolicySpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * NetworkPolicy describes what network traffic is allowed for a set of Pods
 */
class NetworkPolicy implements APIResourceInterface
{
    const API_VERSION = 'networking.k8s.io/v1';
    const KIND = 'NetworkPolicy';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the desired behavior for this NetworkPolicy.
     */
    private NetworkPolicySpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new NetworkPolicySpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): NetworkPolicySpec
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
