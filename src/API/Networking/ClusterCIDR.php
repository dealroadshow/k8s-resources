<?php

declare(strict_types=1);

namespace Dealroadshow\K8S\API\Networking;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ClusterCIDRSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * ClusterCIDR represents a single configuration for per-Node Pod CIDR allocations
 * when the MultiCIDRRangeAllocator is enabled (see the config for
 * kube-controller-manager).  A cluster may have any number of ClusterCIDR
 * resources, all of which will be considered when allocating a CIDR for a Node.  A
 * ClusterCIDR is eligible to be used for a given Node when the node selector
 * matches the node in question and has free CIDRs to allocate.  In case of
 * multiple matching ClusterCIDR resources, the allocator will attempt to break
 * ties using internal heuristics, but any ClusterCIDR whose node selector matches
 * the Node may be used.
 */
class ClusterCIDR implements APIResourceInterface
{
    public const API_VERSION = 'networking.k8s.io/v1alpha1';
    public const KIND = 'ClusterCIDR';

    /**
     * Standard object's metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec is the desired state of the ClusterCIDR. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private ClusterCIDRSpec $spec;

    public function __construct(ClusterCIDRSpec $spec)
    {
        $this->metadata = new ObjectMeta();
        $this->spec = $spec;
    }

    public function getSpec(): ClusterCIDRSpec
    {
        return $this->spec;
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function setSpec(ClusterCIDRSpec $spec): self
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
