<?php 

namespace Dealroadshow\K8S\API;

use Dealroadshow\K8S\APIResourceInterface;
use Dealroadshow\K8S\Data\ObjectMeta;
use Dealroadshow\K8S\Data\ReplicationControllerSpec;

/**
 * ReplicationController represents the configuration of a replication controller.
 */
class ReplicationController implements APIResourceInterface
{
    const API_VERSION = 'v1';
    const KIND = 'ReplicationController';

    /**
     * If the Labels of a ReplicationController are empty, they are defaulted to be the
     * same as the Pod(s) that the replication controller manages. Standard object's
     * metadata. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#metadata
     */
    private ObjectMeta $metadata;

    /**
     * Spec defines the specification of the desired behavior of the replication
     * controller. More info:
     * https://git.k8s.io/community/contributors/devel/sig-architecture/api-conventions.md#spec-and-status
     */
    private ReplicationControllerSpec $spec;

    public function __construct()
    {
        $this->metadata = new ObjectMeta();
        $this->spec = new ReplicationControllerSpec();
    }

    public function metadata(): ObjectMeta
    {
        return $this->metadata;
    }

    public function spec(): ReplicationControllerSpec
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
