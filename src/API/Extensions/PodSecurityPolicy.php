<?php 

namespace Dealroadshow\K8S\API\Extensions;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\PodSecurityPolicySpec;

/**
 * PodSecurityPolicy governs the ability to make requests that affect the Security
 * Context that will be applied to a pod and container. Deprecated: use
 * PodSecurityPolicy from policy API Group instead.
 */
class PodSecurityPolicy implements APIResourceInterface
{
    const API_VERSION = 'extensions/v1beta1';
    const KIND = 'PodSecurityPolicy';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * spec defines the policy enforced.
     */
    private PodSecurityPolicySpec $spec;

    public function __construct(PodSecurityPolicySpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): PodSecurityPolicySpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(PodSecurityPolicySpec $spec): self
    {
        $this->spec = $spec;

        return $this;
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
