<?php 

namespace Dealroadshow\K8S\API\Coordination;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\LeaseSpec;
use Dealroadshow\K8S\Data\ObjectMeta;

/**
 * Lease defines a lease concept.
 */
class Lease implements APIResourceInterface
{
    const API_VERSION = 'coordination.k8s.io/v1';
    const KIND = 'Lease';

    /**
     * More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Specification of the Lease. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private LeaseSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new LeaseSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): LeaseSpec
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
